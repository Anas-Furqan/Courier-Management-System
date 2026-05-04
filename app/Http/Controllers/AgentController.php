<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function dashboard()
    {
        $agent = auth()->user()->agent;

        $shipments = Shipment::with(['sender', 'receiver'])
            ->where(function ($query) use ($agent) {
                $query->where('from_city', $agent->branch_city)
                    ->orWhere('to_city', $agent->branch_city);
            })
            ->latest()
            ->take(8)
            ->get();

        $totalShipments = $shipments->count();
        $inTransitCount = $shipments->where('status', 'in_transit')->count();
        $deliveredCount = $shipments->where('status', 'delivered')->count();
        $pendingCount = $shipments->where('status', 'pending')->count();

        return view('agent.dashboard', compact(
            'agent',
            'shipments',
            'totalShipments',
            'inTransitCount',
            'deliveredCount',
            'pendingCount'
        ));
    }

    public function index()
    {
        return redirect()->route('agent.dashboard');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
