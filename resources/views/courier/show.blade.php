@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #8B5CF6, #A78BFA); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">{{ $shipment->tracking_number }}</h1>
        <p class="text-lg font-bold">Courier Details & Tracking</p>
        <div class="flex gap-4 mt-4">
            <a href="{{ route('track.view', $shipment->tracking_number) }}" class="neo-btn px-4 py-2 bg-black text-white border-2 border-black" style="box-shadow: 4px 4px 0 0 #000;">Public View</a>
            <a href="{{ route('couriers.edit', $shipment->id) }}" class="neo-btn px-4 py-2 bg-yellow-300 border-2 border-black" style="box-shadow: 4px 4px 0 0 #000; color: black;">Edit</a>
        </div>
    </div>

    <!-- Route & Status Cards -->
    <div class="grid gap-6 md:grid-cols-2">
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2 uppercase">Route</p>
            <p class="text-2xl font-black">{{ $shipment->from_city }} → {{ $shipment->to_city }}</p>
        </div>
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2 uppercase">Status</p>
            <p class="text-2xl font-black" style="color: {{ $shipment->status === 'delivered' ? '#4ADE80' : ($shipment->status === 'in_transit' ? '#06B6D4' : '#FCD34D') }};">{{ str_replace('_', ' ', $shipment->status) }}</p>
        </div>
    </div>

    <!-- Tracking Timeline -->
    <div class="border-4 border-black bg-white" style="box-shadow: 8px 8px 0 #000;">
        <div class="text-white border-b-4 border-black p-6" style="background-color: #8B5CF6;">
            <h2 class="text-2xl font-black">Tracking Timeline</h2>
        </div>
        <div class="p-8 space-y-4">
            @forelse($shipment->tracking as $track)
                <div class="border-l-4 border-black pl-6 pb-4">
                    <p class="font-black text-lg">{{ $track->status }} • {{ $track->location }}</p>
                    <p class="font-bold text-gray-600 text-sm mt-1">{{ $track->notes }}</p>
                </div>
            @empty
                <p class="font-bold text-gray-600 text-center py-8">No tracking history available.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection