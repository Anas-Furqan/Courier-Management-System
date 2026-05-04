<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\Customer;
use App\Models\ShipmentTracking;
use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            $shipments = Shipment::with('sender', 'receiver', 'creator')->latest()->paginate(15);
        } elseif ($user->isAgent()) {
            $agent = $user->agent;
            $shipments = Shipment::where(function ($q) use ($agent) {
                $q->where('from_city', $agent->branch_city)
                  ->orWhere('to_city', $agent->branch_city);
            })->with('sender', 'receiver', 'creator')->latest()->paginate(15);
        } else {
            return redirect('/')->with('error', 'Unauthorized');
        }

        return view('courier.index', compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('courier.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShipmentRequest $request)
    {
        // Generate tracking number
        $trackingNumber = 'CMS' . date('YmdHis') . random_int(1000, 9999);

        $shipment = Shipment::create([
            ...$request->validated(),
            'tracking_number' => $trackingNumber,
            'booking_date' => now()->date(),
            'created_by' => auth()->id(),
            'status' => 'pending',
        ]);

        // Create initial tracking record
        ShipmentTracking::create([
            'shipment_id' => $shipment->id,
            'status' => 'pending',
            'location' => $request->from_city,
            'notes' => 'Shipment booked',
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('couriers.show', $shipment->id)->with('success', "Shipment created! Tracking #: {$trackingNumber}");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shipment = Shipment::with('sender', 'receiver', 'creator', 'tracking')->findOrFail($id);
        $tracking = $shipment->tracking;
        
        return view('courier.show', compact('shipment', 'tracking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shipment = Shipment::findOrFail($id);
        
        // Only edit if not delivered
        if ($shipment->status === 'delivered') {
            return back()->with('error', 'Cannot edit delivered shipments');
        }

        $customers = Customer::all();
        return view('courier.edit', compact('shipment', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShipmentRequest $request, string $id)
    {
        $shipment = Shipment::findOrFail($id);
        
        if ($shipment->status === 'delivered') {
            return back()->with('error', 'Cannot update delivered shipments');
        }

        $shipment->update($request->validated());
        
        return back()->with('success', 'Shipment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipment = Shipment::findOrFail($id);
        
        if ($shipment->status === 'delivered') {
            return back()->with('error', 'Cannot delete delivered shipments');
        }

        $shipment->delete();
        
        return redirect()->route('couriers.index')->with('success', 'Shipment deleted successfully');
    }

    /**
     * Update shipment status
     */
    public function updateStatus(Request $request, string $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_transit,delivered,cancelled',
            'location' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $shipment = Shipment::findOrFail($id);
        $shipment->status = $validated['status'];
        
        if ($validated['status'] === 'delivered') {
            $shipment->actual_delivery_date = now()->date();
        }
        
        $shipment->save();

        // Create tracking record
        ShipmentTracking::create([
            'shipment_id' => $shipment->id,
            'status' => $validated['status'],
            'location' => $validated['location'],
            'notes' => $validated['notes'],
            'updated_by' => auth()->id(),
        ]);

        return back()->with('success', 'Status updated successfully');
    }
}
