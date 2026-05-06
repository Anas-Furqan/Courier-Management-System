@extends('layouts.app')

@section('page-title', 'Admin Dashboard')

@section('content')
<div class="space-y-8">

    {{-- Hero --}}
    <div class="page-hero bg-purple-400">
        <h1 class="text-4xl font-black mb-1">Admin Dashboard</h1>
        <p class="font-bold text-black/70">Command every operation and monitor all activities.</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <div class="stat-neo bg-yellow-300 text-center">
            <p class="stat-neo-label">Total</p>
            <p class="stat-neo-value">{{ $totalShipments }}</p>
        </div>
        <div class="stat-neo bg-green-400 text-center">
            <p class="stat-neo-label">Delivered</p>
            <p class="stat-neo-value">{{ $deliveredCount }}</p>
        </div>
        <div class="stat-neo bg-cyan-400 text-center">
            <p class="stat-neo-label">In Transit</p>
            <p class="stat-neo-value">{{ $inTransitCount }}</p>
        </div>
        <div class="stat-neo bg-orange-400 text-center">
            <p class="stat-neo-label">Pending</p>
            <p class="stat-neo-value">{{ $pendingCount }}</p>
        </div>
        <div class="stat-neo bg-pink-400 text-center">
            <p class="stat-neo-label">Agents</p>
            <p class="stat-neo-value">{{ $totalAgents }}</p>
        </div>
        <div class="stat-neo bg-red-400 text-center">
            <p class="stat-neo-label">Customers</p>
            <p class="stat-neo-value">{{ $totalCustomers }}</p>
        </div>
    </div>

    {{-- Latest Bookings --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-blue-500 text-white border-b-4 border-black">
            <h2 class="text-2xl font-black">Latest Bookings</h2>
            <a href="{{ route('couriers.index') }}" class="neo-btn-sm bg-white text-black flex-shrink-0">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="neo-table">
                <thead>
                    <tr>
                        <th>Tracking #</th>
                        <th>Route</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentShipments as $shipment)
                        <tr>
                            <td class="font-mono">{{ $shipment->tracking_number }}</td>
                            <td>{{ $shipment->from_city }} → {{ $shipment->to_city }}</td>
                            <td>
                                <span class="s-{{ $shipment->status }}">{{ str_replace('_',' ',$shipment->status) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-12 text-gray-500">No bookings yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
