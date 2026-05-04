@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <section class="hero-panel" data-reveal>
        <div>
            <p class="section-kicker">Agent Dashboard</p>
            <h1 class="mt-3 text-4xl font-black text-white">{{ $agent->branch_city }} Operations</h1>
            <p class="mt-3 max-w-2xl text-slate-300">Manage and track all shipments for your branch with real-time updates and comprehensive analytics.</p>
        </div>
        <div class="flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('couriers.create') }}" class="btn-primary">+ Add Shipment</a>
            <a href="{{ route('couriers.index') }}" class="btn-secondary">View All</a>
        </div>
    </section>

    <section class="grid gap-4 md:grid-cols-4" data-reveal>
        <div class="stat-card"><p class="stat-label">Total</p><p class="stat-value">{{ $totalShipments }}</p></div>
        <div class="stat-card"><p class="stat-label">Delivered</p><p class="stat-value text-emerald-300">{{ $deliveredCount }}</p></div>
        <div class="stat-card"><p class="stat-label">In Transit</p><p class="stat-value text-cyan-300">{{ $inTransitCount }}</p></div>
        <div class="stat-card"><p class="stat-label">Pending</p><p class="stat-value text-amber-300">{{ $pendingCount ?? 0 }}</p></div>
    </section>

    <section class="glass-panel overflow-hidden" data-reveal>
        <div class="border-b border-white/10 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Recent Shipments</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-slate-300">Tracking #</th>
                        <th class="px-6 py-3 font-semibold text-slate-300">Route</th>
                        <th class="px-6 py-3 font-semibold text-slate-300">Status</th>
                        <th class="px-6 py-3 font-semibold text-slate-300">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($recentShipments ?? [] as $shipment)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-mono text-white">{{ $shipment->tracking_number ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $shipment->from_city ?? 'N/A' }} → {{ $shipment->to_city ?? 'N/A' }}</td>
                            <td class="px-6 py-4"><span class="status-pill status-{{ $shipment->status ?? 'pending' }}">{{ str_replace('_', ' ', $shipment->status ?? 'pending') }}</span></td>
                            <td class="px-6 py-4"><a href="{{ route('couriers.show', $shipment->id ?? 0) }}" class="text-cyan-400 hover:text-cyan-300 transition text-sm font-semibold">View →</a></td>
                        </tr>
                    @empty
                        <tr><td class="px-6 py-10 text-center text-slate-400" colspan="4">No shipments yet. Create your first shipment to get started.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection