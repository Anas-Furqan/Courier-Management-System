@extends('layouts.app')

@section('page-title', 'Customer Dashboard')

@section('content')
<div class="space-y-8">
    <section class="hero-panel" data-reveal>
        <div>
            <p class="section-kicker">Customer Portal</p>
            <h1 class="mt-3 text-4xl font-black text-white">Track your shipments</h1>
            <p class="mt-3 max-w-2xl text-slate-300">Monitor all your deliveries in real-time with detailed tracking and delivery updates.</p>
        </div>
    </section>

    <section class="grid gap-4 md:grid-cols-3 lg:grid-cols-4" data-reveal>
        <div class="stat-card"><p class="stat-label">Total</p><p class="stat-value">{{ $totalShipments }}</p></div>
        <div class="stat-card"><p class="stat-label">In Transit</p><p class="stat-value text-cyan-300">{{ $inTransitCount }}</p></div>
        <div class="stat-card"><p class="stat-label">Delivered</p><p class="stat-value text-emerald-300">{{ $deliveredCount }}</p></div>
        <div class="stat-card"><p class="stat-label">Pending</p><p class="stat-value text-amber-300">{{ $pendingCount ?? 0 }}</p></div>
    </section>

    <section class="glass-panel p-8" data-reveal>
        <div class="mb-6">
            <p class="section-kicker">Quick Tracking</p>
            <h2 class="mt-2 text-2xl font-bold text-white">Search by tracking number</h2>
        </div>
        <form class="flex flex-col gap-4 sm:flex-row" action="#" method="GET" onsubmit="event.preventDefault(); const value = this.querySelector('input').value.trim(); if (value) { window.location.href = '{{ url('/track') }}/' + encodeURIComponent(value); }">
            <input class="input-field flex-1" type="text" placeholder="Enter tracking number (e.g., CMS202605040001)" aria-label="Tracking number" required>
            <button class="btn-primary whitespace-nowrap" type="submit">Search</button>
        </form>
    </section>

    <section class="glass-panel p-8" data-reveal>
        <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <p class="section-kicker">Recent Activity</p>
                <h2 class="mt-2 text-2xl font-bold text-white">Your shipments</h2>
            </div>
            <a href="{{ route('track.search') }}" class="btn-secondary text-center">View All Tracking</a>
        </div>

        @if($shipments->count() > 0)
            <div class="space-y-4">
                @foreach($shipments as $shipment)
                    <div class="rounded-lg border border-white/10 bg-white/5 p-4 transition hover:bg-white/10">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="font-semibold text-white">{{ $shipment->tracking_number }}</p>
                                <p class="text-sm text-slate-400">{{ $shipment->from_city }} → {{ $shipment->to_city }}</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="status-pill status-{{ $shipment->status }}">{{ str_replace('_', ' ', $shipment->status) }}</span>
                                <a href="{{ route('track.view', $shipment->tracking_number) }}" class="text-cyan-400 hover:text-cyan-300 text-sm font-semibold transition">Details →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-lg border-2 border-dashed border-white/10 bg-white/5 p-12 text-center">
                <p class="text-slate-400">No shipments yet. Create your first shipment to see it here.</p>
                <a href="{{ route('track.search') }}" class="btn-primary mt-4 inline-block">Start Tracking</a>
            </div>
        @endif
    </section>
</div>
@endsection
