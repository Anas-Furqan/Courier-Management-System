@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <section class="hero-panel" data-reveal>
        <div>
            <p class="section-kicker">Customer Dashboard</p>
            <h1 class="mt-3 text-4xl font-black text-white">Welcome, {{ $user->name }}</h1>
            <p class="mt-3 max-w-2xl text-slate-300">Monitor your shipments, open tracking details instantly, and keep your profile in sync.</p>
        </div>
        <a href="{{ url('/track') }}" class="btn-primary">Track Shipment</a>
    </section>

    <section class="grid gap-4 md:grid-cols-3" data-reveal>
        <div class="stat-card">
            <p class="stat-label">Shipments</p>
            <p class="stat-value">{{ $shipments->count() }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">City</p>
            <p class="stat-value text-cyan-300">{{ $customer->city ?? 'N/A' }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Portal</p>
            <p class="stat-value text-emerald-300">Active</p>
        </div>
    </section>

    <section class="glass-panel overflow-hidden" data-reveal>
        <div class="flex items-center justify-between border-b border-white/10 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Recent Shipments</h2>
            <a href="{{ route('customer.shipments') }}" class="text-sm text-cyan-300 hover:text-cyan-200">View all</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.25em] text-slate-400">
                    <tr>
                        <th class="px-6 py-4">Tracking</th>
                        <th class="px-6 py-4">From</th>
                        <th class="px-6 py-4">To</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($shipments as $shipment)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-semibold text-white">{{ $shipment->tracking_number }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $shipment->from_city }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $shipment->to_city }}</td>
                            <td class="px-6 py-4"><span class="status-pill status-{{ $shipment->status }}">{{ str_replace('_', ' ', $shipment->status) }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-10 text-center text-slate-400">No shipments yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection