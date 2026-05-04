@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8 flex justify-between items-center" style="background: linear-gradient(to right, #10B981, #059669); box-shadow: 8px 8px 0 #000;">
        <div>
            <h1 class="text-4xl font-black mb-2">Courier Inventory</h1>
            <p class="text-lg font-bold">View and manage all shipments in your system.</p>
        </div>
        <a href="{{ route('couriers.create') }}" class="neo-btn bg-black text-white px-6 py-3" style="border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000;">+ New Shipment</a>
    </div>

    <!-- Shipments Table -->
    <div class="border-4 border-black bg-white" style="box-shadow: 8px 8px 0 #000;">
        <div class="text-white border-b-4 border-black p-6" style="background-color: #10B981;">
            <h2 class="text-2xl font-black">All Shipments ({{ $shipments->count() }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-4 border-black bg-gray-200">
                        <th class="px-6 py-4 text-left font-black">Tracking #</th>
                        <th class="px-6 py-4 text-left font-black">Route</th>
                        <th class="px-6 py-4 text-left font-black">Status</th>
                        <th class="px-6 py-4 text-left font-black">Date</th>
                        <th class="px-6 py-4 text-left font-black">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shipments as $shipment)
                        <tr class="border-b-2 border-black hover:bg-gray-100">
                            <td class="px-6 py-4 font-mono font-bold">{{ $shipment->tracking_number }}</td>
                            <td class="px-6 py-4 font-bold">{{ $shipment->from_city }} → {{ $shipment->to_city }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 font-bold text-sm uppercase border-2 border-black" style="background-color: {{ $shipment->status === 'delivered' ? '#4ADE80' : ($shipment->status === 'in_transit' ? '#06B6D4' : '#FCD34D') }};">{{ str_replace('_', ' ', $shipment->status) }}</span>
                            </td>
                            <td class="px-6 py-4 font-bold text-sm">{{ $shipment->booking_date?->format('M d, Y') ?? 'N/A' }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('couriers.show', $shipment->id) }}" class="px-3 py-1 bg-cyan-400 border-2 border-black font-bold text-sm">View</a>
                                <a href="{{ route('couriers.edit', $shipment->id) }}" class="px-3 py-1 bg-yellow-300 border-2 border-black font-bold text-sm">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center font-bold">No shipments found. Create your first shipment to get started.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection