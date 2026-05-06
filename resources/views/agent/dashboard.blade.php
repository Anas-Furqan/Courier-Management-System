@extends('layouts.app')

@section('page-title', 'Agent Dashboard')

@section('content')
<div class="space-y-8">

    {{-- Hero --}}
    <div class="page-hero bg-green-400 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-black mb-1">{{ $agent->branch_city }} Operations</h1>
            <p class="font-bold text-black/70">Manage and track all shipments for your branch.</p>
        </div>
        <div class="flex gap-3 flex-wrap">
            <a href="{{ route('agent.couriers.create') }}" class="neo-btn bg-black text-white">+ Add Shipment</a>
            <a href="{{ route('agent.couriers.index') }}" class="neo-btn bg-white text-black">View All</a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="stat-neo bg-yellow-300 text-center">
            <p class="stat-neo-label">Total</p>
            <p class="stat-neo-value">{{ $totalShipments }}</p>
        </div>
        <div class="stat-neo bg-green-400 text-center">
            <p class="stat-neo-label">Delivered</p>
            <p class="stat-neo-value">{{ $deliveredCount }}</p>
        </div>
        <div class="stat-neo bg-cyan-400 text-center">
            <p class="stat-neo-label">In Transit</p>
            <p class="stat-neo-value">{{ $inTransitCount }}</p>
        </div>
        <div class="stat-neo bg-orange-400 text-center">
            <p class="stat-neo-label">Pending</p>
            <p class="stat-neo-value">{{ $pendingCount ?? 0 }}</p>
        </div>
    </div>

    {{-- Recent Shipments --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-red-500 text-white border-b-4 border-black">
            <h2 class="text-2xl font-black">Recent Shipments</h2>
            <a href="{{ route('agent.couriers.index') }}" class="neo-btn-sm bg-white text-black flex-shrink-0">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="neo-table">
                <thead>
                    <tr>
                        <th>Tracking #</th>
                        <th>Route</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentShipments ?? [] as $shipment)
                        <tr>
                            <td class="font-mono">{{ $shipment->tracking_number ?? 'N/A' }}</td>
                            <td>{{ $shipment->from_city ?? 'N/A' }} → {{ $shipment->to_city ?? 'N/A' }}</td>
                            <td>
                                <span class="s-{{ $shipment->status ?? 'pending' }}">{{ str_replace('_',' ',$shipment->status ?? 'pending') }}</span>
                            </td>
                            <td>
                                <a href="{{ route('agent.couriers.show', $shipment->id ?? 0) }}" class="neo-btn-sm bg-green-400 text-black">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-gray-500">No shipments yet. Create your first shipment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
