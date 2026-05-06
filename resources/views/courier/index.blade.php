@extends('layouts.app')

@section('page-title', 'Shipments')

@section('content')
<div class="space-y-8">

    {{-- Hero --}}
    <div class="page-hero bg-emerald-400 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-black mb-1">Courier Inventory</h1>
            <p class="font-bold text-black/70">View and manage all shipments in your system.</p>
        </div>
        <a href="{{ route('couriers.create') }}" class="neo-btn bg-black text-white flex-shrink-0">+ New Shipment</a>
    </div>

    {{-- Table --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-emerald-500 text-white border-b-4 border-black">
            <h2 class="text-2xl font-black">All Shipments ({{ $shipments->count() }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="neo-table">
                <thead>
                    <tr>
                        <th>Tracking #</th>
                        <th>Route</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shipments as $shipment)
                        <tr>
                            <td class="font-mono font-black">{{ $shipment->tracking_number }}</td>
                            <td>{{ $shipment->from_city }} → {{ $shipment->to_city }}</td>
                            <td>
                                <span class="s-{{ $shipment->status }}">{{ str_replace('_',' ',$shipment->status) }}</span>
                            </td>
                            <td class="text-gray-600 text-xs">{{ $shipment->booking_date?->format('M d, Y') ?? 'N/A' }}</td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('couriers.show', $shipment->id) }}" class="neo-btn-sm bg-cyan-400 text-black">View</a>
                                    <a href="{{ route('couriers.edit', $shipment->id) }}" class="neo-btn-sm bg-yellow-300 text-black">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500">No shipments found. Create your first shipment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
