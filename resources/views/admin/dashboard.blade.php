@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <section class="hero-panel" data-reveal>
        <div>
            <p class="section-kicker">Admin Dashboard</p>
            <h1 class="mt-3 text-4xl font-black text-white">Command every operation</h1>
            <p class="mt-3 max-w-2xl text-slate-300">See shipment totals, branch activity, and the latest bookings in a premium visual control surface.</p>
        </div>
    </section>

    <section class="grid gap-4 md:grid-cols-3 lg:grid-cols-6" data-reveal>
        <div class="stat-card"><p class="stat-label">Total</p><p class="stat-value">{{ $totalShipments }}</p></div>
        <div class="stat-card"><p class="stat-label">Delivered</p><p class="stat-value text-emerald-300">{{ $deliveredCount }}</p></div>
        <div class="stat-card"><p class="stat-label">Transit</p><p class="stat-value text-cyan-300">{{ $inTransitCount }}</p></div>
        <div class="stat-card"><p class="stat-label">Pending</p><p class="stat-value text-amber-300">{{ $pendingCount }}</p></div>
        <div class="stat-card"><p class="stat-label">Agents</p><p class="stat-value text-violet-300">{{ $totalAgents }}</p></div>
        <div class="stat-card"><p class="stat-label">Customers</p><p class="stat-value text-fuchsia-300">{{ $totalCustomers }}</p></div>
    </section>

    <section class="glass-panel overflow-hidden" data-reveal>
        <div class="border-b border-white/10 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Latest Bookings</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <tbody class="divide-y divide-white/10">
                    @forelse($recentShipments as $shipment)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 text-white">{{ $shipment->tracking_number }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $shipment->from_city }} → {{ $shipment->to_city }}</td>
                            <td class="px-6 py-4"><span class="status-pill status-{{ $shipment->status }}">{{ str_replace('_', ' ', $shipment->status) }}</span></td>
                        </tr>
                    @empty
                        <tr><td class="px-6 py-10 text-center text-slate-400">No bookings yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection