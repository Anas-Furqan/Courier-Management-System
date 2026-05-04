@extends('layouts.app')

@section('content')
<div class="space-y-6" data-reveal>
    <div class="hero-panel">
        <div>
            <p class="section-kicker">My Shipments</p>
            <h1 class="mt-3 text-4xl font-black text-white">Shipment history</h1>
        </div>
        <a href="{{ url('/track') }}" class="btn-primary">Track another</a>
    </div>

    <div class="glass-panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.25em] text-slate-400">
                    <tr>
                        <th class="px-6 py-4">Tracking</th>
                        <th class="px-6 py-4">Route</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($shipments as $shipment)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 text-white">{{ $shipment->tracking_number }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $shipment->from_city }} → {{ $shipment->to_city }}</td>
                            <td class="px-6 py-4"><span class="status-pill status-{{ $shipment->status }}">{{ str_replace('_', ' ', $shipment->status) }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-6 py-10 text-center text-slate-400">No shipments found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection