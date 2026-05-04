@extends('layouts.app')

@section('page-title', 'Customer Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #06B6D4, #0EA5E9); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">Track Your Shipments</h1>
        <p class="text-lg font-bold">Monitor all your deliveries in real-time with detailed tracking and updates.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-yellow-300 border-4 border-black p-6" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Total Shipments</p>
            <p class="text-5xl font-black">{{ $totalShipments }}</p>
        </div>
        <div class="bg-cyan-400 border-4 border-black p-6" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">In Transit</p>
            <p class="text-5xl font-black">{{ $inTransitCount }}</p>
        </div>
        <div class="bg-green-400 border-4 border-black p-6" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Delivered</p>
            <p class="text-5xl font-black">{{ $deliveredCount }}</p>
        </div>
        <div class="bg-orange-300 border-4 border-black p-6" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Pending</p>
            <p class="text-5xl font-black">{{ $pendingCount ?? 0 }}</p>
        </div>
    </div>

    <!-- Quick Tracking -->
    <div class="border-4 border-black bg-white p-8" style="box-shadow: 8px 8px 0 #000;">
        <h2 class="text-3xl font-black mb-6">Quick Tracking</h2>
        <form class="flex flex-col md:flex-row gap-4" action="{{ route('track.search') }}" method="GET">
            <input type="text" name="tracking_number" placeholder="Enter tracking number..." class="neo-input flex-1" required>
            <button type="submit" class="neo-btn bg-black text-white px-8 py-3">Search</button>
        </form>
    </div>

    <!-- Recent Shipments -->
    <div class="border-4 border-black bg-white" style="box-shadow: 8px 8px 0 #000;">
        <div class="bg-pink-400 border-b-4 border-black p-6">
            <h2 class="text-2xl font-black">Recent Shipments</h2>
        </div>
        <div class="p-6">
            @if($shipments->count() > 0)
                <div class="space-y-4">
                    @foreach($shipments as $shipment)
                        <div class="border-2 border-black p-4 flex justify-between items-center">
                            <div>
                                <p class="text-lg font-black">{{ $shipment->tracking_number }}</p>
                                <p class="font-bold">{{ $shipment->from_city }} → {{ $shipment->to_city }}</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="px-4 py-2 bg-blue-300 border-2 border-black font-bold uppercase text-sm">{{ $shipment->status }}</span>
                                <a href="{{ route('track.view', $shipment->tracking_number) }}" class="px-4 py-2 bg-green-400 border-2 border-black font-bold">View</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="border-4 border-dashed border-black p-12 text-center">
                    <p class="text-xl font-black mb-4">No shipments yet</p>
                    <a href="{{ route('track.search') }}" class="inline-block px-6 py-3 bg-blue-500 text-white border-4 border-black font-black" style="box-shadow: 4px 4px 0 #000;">Start Tracking</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
                <p class="text-slate-400">No shipments yet. Create your first shipment to see it here.</p>
                <a href="{{ route('track.search') }}" class="btn-primary mt-4 inline-block">Start Tracking</a>
            </div>
        @endif
    </section>
</div>
@endsection
