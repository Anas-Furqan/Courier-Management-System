@extends('layouts.app')

@section('page-title', 'Customer Dashboard')

@section('content')
<div class="space-y-8">

    {{-- Hero --}}
    <div class="page-hero bg-cyan-400 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-black mb-1">Welcome, {{ $user->name }}</h1>
            <p class="font-bold text-black/70">Monitor your shipments and track packages in real-time.</p>
        </div>
        <a href="{{ url('/track') }}" class="neo-btn bg-black text-white flex-shrink-0">Track Shipment</a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="stat-neo bg-yellow-300 text-center">
            <p class="stat-neo-label">Total Shipments</p>
            <p class="stat-neo-value">{{ $shipments->count() }}</p>
        </div>
        <div class="stat-neo bg-cyan-400 text-center">
            <p class="stat-neo-label">City</p>
            <p class="stat-neo-value text-2xl">{{ $customer->city ?? 'N/A' }}</p>
        </div>
        <div class="stat-neo bg-green-400 text-center">
            <p class="stat-neo-label">Portal Status</p>
            <p class="stat-neo-value text-2xl">Active</p>
        </div>
    </div>

    {{-- Recent Shipments --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-cyan-500 text-white border-b-4 border-black">
            <h2 class="text-xl font-black">Recent Shipments</h2>
            <a href="{{ route('customer.shipments') }}" class="neo-btn-sm bg-white text-black flex-shrink-0">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="neo-table">
                <thead>
                    <tr>
                        <th>Tracking #</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shipments as $shipment)
                        <tr>
                            <td class="font-black font-mono">{{ $shipment->tracking_number }}</td>
                            <td>{{ $shipment->from_city }}</td>
                            <td>{{ $shipment->to_city }}</td>
                            <td>
                                <span class="s-{{ $shipment->status }}">{{ str_replace('_',' ',$shipment->status) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-gray-500">No shipments yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
