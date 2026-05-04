<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->paginate(10);

        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|in:shipment,city_wise,date_wise',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
            'city' => 'nullable|string|max:255',
        ]);

        $query = Shipment::query();

        if (!empty($validated['from_date'])) {
            $query->whereDate('booking_date', '>=', $validated['from_date']);
        }

        if (!empty($validated['to_date'])) {
            $query->whereDate('booking_date', '<=', $validated['to_date']);
        }

        if (!empty($validated['city'])) {
            $query->where(function ($builder) use ($validated) {
                $builder->where('from_city', $validated['city'])
                    ->orWhere('to_city', $validated['city']);
            });
        }

        $shipments = $query->latest()->get();
        $csv = "tracking_number,from_city,to_city,status,booking_date\n";

        foreach ($shipments as $shipment) {
            $csv .= implode(',', [
                $shipment->tracking_number,
                $shipment->from_city,
                $shipment->to_city,
                $shipment->status,
                optional($shipment->booking_date)->format('Y-m-d'),
            ]) . "\n";
        }

        $fileName = 'reports/report_' . now()->format('YmdHis') . '.csv';
        Storage::disk('public')->put($fileName, $csv);

        Report::create([
            'generated_by' => auth()->id() ?? 1,
            'report_type' => $validated['report_type'],
            'filters' => $validated,
            'file_path' => $fileName,
            'download_count' => 0,
        ]);

        return back()->with('success', 'Report generated successfully');
    }

    public function show(string $id)
    {
        return redirect()->route('admin.reports.index');
    }

    public function edit(string $id)
    {
        return redirect()->route('admin.reports.index');
    }

    public function update(Request $request, string $id)
    {
        return redirect()->route('admin.reports.index');
    }

    public function destroy(string $id)
    {
        Report::findOrFail($id)->delete();

        return back()->with('success', 'Report deleted successfully');
    }

    public function download(string $id)
    {
        $report = Report::findOrFail($id);
        $report->increment('download_count');

        return Storage::disk('public')->download($report->file_path);
    }
}
