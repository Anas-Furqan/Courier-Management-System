@extends('layouts.app')

@section('content')
<div class="space-y-8" data-reveal>
    <div class="hero-panel">
        <div>
            <p class="section-kicker">Shipment Management</p>
            <h1 class="mt-3 text-4xl font-black text-white">Courier Inventory</h1>
            <p class="mt-3 max-w-2xl text-slate-300">View and manage all shipments in your system.</p>
        </div>
        <a href="{{ route('couriers.create') }}" class="btn-primary">+ New Shipment</a>
    </div>

    <div class="glass-panel overflow-hidden">
        <div class="border-b border-white/10 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">All Shipments ({{ $shipments->count() }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.25em] text-slate-400">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Tracking #</th>
                        <th class="px-6 py-4 font-semibold">Route</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold">Date</th>
                        <th class="px-6 py-4 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($shipments as $shipment)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-mono text-white">{{ $shipment->tracking_number }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $shipment->from_city }} → {{ $shipment->to_city }}</td>
                            <td class="px-6 py-4"><span class="status-pill status-{{ $shipment->status }}">{{ str_replace('_', ' ', $shipment->status) }}</span></td>
                            <td class="px-6 py-4 text-slate-400 text-sm">{{ $shipment->booking_date?->format('M d, Y') ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex gap-2">
                                    <a href="{{ route('couriers.show', $shipment->id) }}" class="text-cyan-400 hover:text-cyan-300 transition font-semibold">View</a>
                                    <span class="text-white/20">•</span>
                                    <a href="{{ route('couriers.edit', $shipment->id) }}" class="text-blue-400 hover:text-blue-300 transition font-semibold">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-10 text-center text-slate-400">No shipments found. Create your first shipment to get started.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection