@extends('layouts.app')

@section('page-title', 'Tracking Result')

@section('content')
<div class="space-y-8 max-w-4xl">

    {{-- Hero --}}
    <div class="page-hero bg-emerald-400 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <div>
            <p class="text-xs font-black uppercase tracking-widest mb-2 text-black/60">Tracking Number</p>
            <h1 class="text-3xl font-black font-mono mb-2">{{ $shipment->tracking_number }}</h1>
            <span class="s-{{ $shipment->status }}">{{ str_replace('_',' ',$shipment->status) }}</span>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('track.print', $shipment->tracking_number) }}" class="neo-btn-sm bg-black text-white">🖨️ Print</a>
            <a href="{{ route('track.search') }}" class="neo-btn-sm bg-white text-black">Track Another</a>
        </div>
    </div>

    {{-- Key Info --}}
    <div class="grid gap-6 md:grid-cols-3">
        <div class="info-card">
            <p class="info-label">From Location</p>
            <p class="info-value text-cyan-600">{{ $shipment->from_city }}</p>
        </div>
        <div class="info-card">
            <p class="info-label">To Location</p>
            <p class="info-value text-blue-600">{{ $shipment->to_city }}</p>
        </div>
        <div class="info-card">
            <p class="info-label">Status</p>
            <span class="s-{{ $shipment->status }} mt-1 inline-block">{{ str_replace('_',' ',$shipment->status) }}</span>
        </div>
    </div>

    {{-- Shipment Info --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-emerald-500 text-white border-b-4 border-black">
            <h2 class="text-xl font-black">Shipment Information</h2>
        </div>
        <div class="p-6 grid gap-6 md:grid-cols-2">
            <div>
                <p class="info-label">Courier Type</p>
                <p class="font-black text-lg">{{ ucfirst($shipment->courier_type ?? 'Standard') }}</p>
            </div>
            <div>
                <p class="info-label">Weight</p>
                <p class="font-black text-lg">{{ $shipment->weight ?? 'N/A' }} kg</p>
            </div>
            <div>
                <p class="info-label">Booked Date</p>
                <p class="font-black text-lg">{{ $shipment->booking_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="info-label">Expected Delivery</p>
                <p class="font-black text-lg">{{ $shipment->expected_delivery_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
            @if($shipment->actual_delivery_date)
            <div class="md:col-span-2 border-4 border-black p-4 bg-green-100" style="box-shadow:4px 4px 0 #000;">
                <p class="info-label">Delivered On</p>
                <p class="font-black text-lg text-green-700">✓ {{ $shipment->actual_delivery_date->format('M d, Y H:i A') }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Tracking History --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-emerald-500 text-white border-b-4 border-black">
            <h2 class="text-xl font-black">Tracking History</h2>
        </div>
        <div class="p-8">
            @if($shipment->tracking && $shipment->tracking->count() > 0)
                @foreach($shipment->tracking->reverse() as $track)
                    <div class="track-event">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-1">
                            <div>
                                <p class="font-black text-base">{{ ucfirst(str_replace('_',' ',$track->status)) }}</p>
                                <p class="font-bold text-sm text-cyan-700">{{ $track->location ?? 'Location TBD' }}</p>
                            </div>
                            <span class="text-xs font-bold text-gray-500 flex-shrink-0">{{ $track->created_at?->format('M d, Y H:i A') ?? 'N/A' }}</span>
                        </div>
                        @if($track->notes)
                            <p class="text-sm font-bold mt-2 text-gray-700 leading-relaxed">{{ $track->notes }}</p>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="border-4 border-dashed border-black p-10 text-center">
                    <p class="font-black text-lg mb-2">No tracking updates yet</p>
                    <p class="text-sm font-bold text-gray-600">Updates will appear here as your shipment progresses.</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
