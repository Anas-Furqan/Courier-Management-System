@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #10B981, #059669); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">{{ $shipment->tracking_number }}</h1>
        <p class="text-lg font-bold mb-4">Current Status: <span style="color: {{ $shipment->status === 'delivered' ? '#4ADE80' : ($shipment->status === 'in_transit' ? '#06B6D4' : '#FCD34D') }}; font-weight: 900;">{{ str_replace('_', ' ', $shipment->status) }}</span></p>
        <div class="flex gap-4 flex-wrap">
            <a href="{{ route('track.print', $shipment->tracking_number) }}" class="neo-btn px-4 py-2 bg-black text-white border-2 border-black" style="box-shadow: 4px 4px 0 0 #000;">🖨️ Print</a>
            <a href="{{ route('track.search') }}" class="neo-btn px-4 py-2 bg-green-400 border-2 border-black" style="box-shadow: 4px 4px 0 0 #000; color: black;">Track Another</a>
        </div>
    </div>

    <!-- Key Stats -->
    <div class="grid gap-6 md:grid-cols-3">
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2 uppercase">From Location</p>
            <p class="text-2xl font-black" style="color: #06B6D4;">{{ $shipment->from_city }}</p>
        </div>
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2 uppercase">To Location</p>
            <p class="text-2xl font-black" style="color: #3B82F6;">{{ $shipment->to_city }}</p>
        </div>
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2 uppercase">Status</p>
            <p class="text-2xl font-black px-3 py-1 border-2 border-black" style="background-color: {{ $shipment->status === 'delivered' ? '#4ADE80' : ($shipment->status === 'in_transit' ? '#06B6D4' : '#FCD34D') }};">{{ str_replace('_', ' ', $shipment->status) }}</p>
        </div>
    </div>

    <!-- Shipment Details -->
    <div class="border-4 border-black bg-white" style="box-shadow: 8px 8px 0 #000;">
        <div class="text-white border-b-4 border-black p-6" style="background-color: #10B981;">
            <h2 class="text-2xl font-black">Shipment Information</h2>
        </div>
        <div class="p-8 grid gap-6 md:grid-cols-2">
            <div>
                <p class="text-sm font-bold text-gray-600 uppercase">Courier Type</p>
                <p class="text-xl font-black mt-2">{{ ucfirst($shipment->courier_type ?? 'Standard') }}</p>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-600 uppercase">Weight</p>
                <p class="text-xl font-black mt-2">{{ $shipment->weight ?? 'N/A' }} kg</p>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-600 uppercase">Booked Date</p>
                <p class="text-xl font-black mt-2">{{ $shipment->booking_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-600 uppercase">Expected Delivery</p>
                <p class="text-xl font-black mt-2">{{ $shipment->expected_delivery_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
            @if($shipment->actual_delivery_date)
            <div class="md:col-span-2">
                <p class="text-sm font-bold text-gray-600 uppercase">Delivered On</p>
                <p class="text-xl font-black mt-2" style="color: #4ADE80;">✓ {{ $shipment->actual_delivery_date->format('M d, Y H:i A') }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Tracking Timeline -->
    <div class="border-4 border-black bg-white" style="box-shadow: 8px 8px 0 #000;">
        <div class="text-white border-b-4 border-black p-6" style="background-color: #10B981;">
            <h2 class="text-2xl font-black">Tracking History</h2>
        </div>
        <div class="p-8">
            @if($shipment->tracking && $shipment->tracking->count() > 0)
                <div class="space-y-6">
                    @foreach($shipment->tracking->reverse() as $track)
                        <div class="border-l-4 border-black pl-6">
                            <div class="flex justify-between gap-4 flex-col sm:flex-row sm:items-start">
                                <div>
                                    <p class="font-black text-lg">{{ ucfirst(str_replace('_', ' ', $track->status)) }}</p>
                                    <p class="text-sm font-bold mt-1" style="color: #06B6D4;">{{ $track->location ?? 'Location TBD' }}</p>
                                </div>
                                <span class="text-xs font-bold text-gray-600 whitespace-nowrap">{{ $track->created_at?->format('M d, Y H:i A') ?? 'N/A' }}</span>
                            </div>
                            @if($track->notes)
                            <p class="text-sm font-bold mt-3 leading-relaxed">{{ $track->notes }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="border-4 border-black p-8 text-center bg-gray-50">
                    <p class="font-bold text-gray-600 mb-2">No tracking updates yet</p>
                    <p class="text-sm font-bold text-gray-500">Updates will appear here as your shipment progresses through delivery stages</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection