@extends('layouts.app')

@section('content')
<div class="space-y-8" data-reveal>
    <div class="hero-panel">
        <div>
            <p class="section-kicker">Shipment Details</p>
            <h1 class="mt-3 text-4xl font-black text-white">{{ $shipment->tracking_number }}</h1>
            <p class="mt-2 text-slate-300">Current Status: <span class="text-cyan-300 font-semibold">{{ str_replace('_', ' ', $shipment->status) }}</span></p>
        </div>
        <div class="flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('track.print', $shipment->tracking_number) }}" class="btn-secondary">🖨️ Print</a>
            <a href="{{ route('track.search') }}" class="btn-primary">Track Another</a>
        </div>
    </div>

    <!-- Key Stats -->
    <div class="grid gap-4 md:grid-cols-3">
        <div class="stat-card">
            <p class="stat-label">From Location</p>
            <p class="stat-value text-cyan-300">{{ $shipment->from_city }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">To Location</p>
            <p class="stat-value text-blue-300">{{ $shipment->to_city }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Status</p>
            <p class="status-pill status-{{ $shipment->status }} inline-block mt-2">{{ str_replace('_', ' ', $shipment->status) }}</p>
        </div>
    </div>

    <!-- Shipment Details -->
    <div class="glass-panel p-8">
        <h2 class="text-xl font-semibold text-white mb-6">Shipment Information</h2>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-slate-400 font-semibold">Courier Type</p>
                <p class="text-lg font-semibold text-white mt-2">{{ ucfirst($shipment->courier_type ?? 'Standard') }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-slate-400 font-semibold">Weight</p>
                <p class="text-lg font-semibold text-white mt-2">{{ $shipment->weight ?? 'N/A' }} kg</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-slate-400 font-semibold">Booked Date</p>
                <p class="text-lg font-semibold text-white mt-2">{{ $shipment->booking_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-slate-400 font-semibold">Expected Delivery</p>
                <p class="text-lg font-semibold text-white mt-2">{{ $shipment->expected_delivery_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
            @if($shipment->actual_delivery_date)
            <div class="md:col-span-2">
                <p class="text-xs uppercase tracking-[0.25em] text-slate-400 font-semibold">Delivered On</p>
                <p class="text-lg font-semibold text-emerald-300 mt-2">✓ {{ $shipment->actual_delivery_date->format('M d, Y H:i A') }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Tracking Timeline -->
    <div class="glass-panel p-8">
        <h2 class="text-xl font-semibold text-white mb-6">Tracking History</h2>
        @if($shipment->tracking && $shipment->tracking->count() > 0)
            <div class="space-y-6">
                @foreach($shipment->tracking->reverse() as $track)
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="flex-1">
                            <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-start">
                                <div>
                                    <p class="font-semibold text-white">{{ ucfirst(str_replace('_', ' ', $track->status)) }}</p>
                                    <p class="text-sm text-cyan-400 mt-1">{{ $track->location ?? 'Location TBD' }}</p>
                                </div>
                                <span class="text-xs text-slate-400 whitespace-nowrap">{{ $track->created_at?->format('M d, Y H:i A') ?? 'N/A' }}</span>
                            </div>
                            @if($track->notes)
                            <p class="text-sm text-slate-300 mt-3 leading-relaxed">{{ $track->notes }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-lg border-2 border-dashed border-white/10 bg-white/5 p-8 text-center">
                <p class="text-slate-400 mb-2">No tracking updates yet</p>
                <p class="text-sm text-slate-500">Updates will appear here as your shipment progresses through delivery stages</p>
            </div>
        @endif
    </div>
</div>
@endsection