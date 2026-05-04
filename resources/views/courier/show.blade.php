@extends('layouts.app')

@section('content')
<div class="space-y-6" data-reveal>
    <div class="hero-panel">
        <div>
            <p class="section-kicker">Courier Details</p>
            <h1 class="mt-3 text-4xl font-black text-white">{{ $shipment->tracking_number }}</h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('track.view', $shipment->tracking_number) }}" class="btn-secondary">Public View</a>
            <a href="{{ route('couriers.edit', $shipment->id) }}" class="btn-primary">Edit</a>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div class="glass-panel p-6"><p class="stat-label">Route</p><p class="mt-2 text-2xl font-bold text-white">{{ $shipment->from_city }} → {{ $shipment->to_city }}</p></div>
        <div class="glass-panel p-6"><p class="stat-label">Status</p><p class="mt-2"><span class="status-pill status-{{ $shipment->status }}">{{ str_replace('_', ' ', $shipment->status) }}</span></p></div>
    </div>

    <div class="glass-panel p-6">
        <h2 class="mb-4 text-xl font-semibold text-white">Tracking Timeline</h2>
        <div class="space-y-4">
            @forelse($shipment->tracking as $track)
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div>
                        <p class="font-semibold text-white">{{ $track->status }} • {{ $track->location }}</p>
                        <p class="text-sm text-slate-400">{{ $track->notes }}</p>
                    </div>
                </div>
            @empty
                <p class="text-slate-400">No tracking history available.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection