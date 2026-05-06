@extends('layouts.app')

@section('page-title', 'Customer Dashboard')

@section('content')
<div class="space-y-8">

    {{-- Hero --}}
    <div class="page-hero bg-cyan-400">
        <h1 class="text-4xl font-black mb-1">Track Your Shipments</h1>
        <p class="font-bold text-black/70">Monitor all your deliveries in real-time.</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="stat-neo bg-yellow-300 text-center">
            <p class="stat-neo-label">Total Shipments</p>
            <p class="stat-neo-value">{{ $totalShipments }}</p>
        </div>
        <div class="stat-neo bg-cyan-400 text-center">
            <p class="stat-neo-label">In Transit</p>
            <p class="stat-neo-value">{{ $inTransitCount }}</p>
        </div>
        <div class="stat-neo bg-green-400 text-center">
            <p class="stat-neo-label">Delivered</p>
            <p class="stat-neo-value">{{ $deliveredCount }}</p>
        </div>
        <div class="stat-neo bg-orange-300 text-center">
            <p class="stat-neo-label">Pending</p>
            <p class="stat-neo-value">{{ $pendingCount ?? 0 }}</p>
        </div>
    </div>

    {{-- Quick Tracking --}}
    <div class="neo-card-xl p-8 bg-white">
        <h2 class="section-title">Quick Track</h2>
        <form class="flex flex-col sm:flex-row gap-4" action="{{ route('track.search') }}" method="GET">
            <input type="text" name="tracking_number" placeholder="Enter tracking number..." class="neo-input flex-1" required>
            <button type="submit" class="neo-btn bg-black text-white flex-shrink-0">Search</button>
        </form>
    </div>

    {{-- Recent Shipments --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-pink-400 text-black border-b-4 border-black">
            <h2 class="text-2xl font-black">Recent Shipments</h2>
            <a href="{{ route('customer.shipments') }}" class="neo-btn-sm bg-black text-white flex-shrink-0">View All</a>
        </div>
        <div class="p-6">
            @if($shipments->count() > 0)
                <div class="space-y-3">
                    @foreach($shipments as $shipment)
                        <div class="border-4 border-black p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 hover:bg-yellow-50 transition-colors" style="box-shadow:3px 3px 0 #000;">
                            <div>
                                <p class="font-black font-mono">{{ $shipment->tracking_number }}</p>
                                <p class="font-bold text-sm text-gray-600">{{ $shipment->from_city }} → {{ $shipment->to_city }}</p>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <span class="s-{{ $shipment->status }}">{{ str_replace('_',' ',$shipment->status) }}</span>
                                <a href="{{ route('track.view', $shipment->tracking_number) }}" class="neo-btn-sm bg-green-400 text-black">View</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="border-4 border-dashed border-black p-12 text-center">
                    <p class="text-xl font-black mb-4">No shipments yet</p>
                    <a href="{{ route('track.search') }}" class="neo-btn bg-blue-500 text-white inline-block">Start Tracking</a>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
