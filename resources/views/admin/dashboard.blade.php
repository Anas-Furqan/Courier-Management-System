@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #C084FC, #EC4899); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">Admin Dashboard</h1>
        <p class="text-lg font-bold">Command every operation and monitor all activities in real-time.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <div class="border-4 border-black p-6 text-center" style="background-color: #FCD34D; box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Total</p>
            <p class="text-5xl font-black">{{ $totalShipments }}</p>
        </div>
        <div class="border-4 border-black p-6 text-center" style="background-color: #4ADE80; box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Delivered</p>
            <p class="text-5xl font-black">{{ $deliveredCount }}</p>
        </div>
        <div class="border-4 border-black p-6 text-center" style="background-color: #06B6D4; box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Transit</p>
            <p class="text-5xl font-black">{{ $inTransitCount }}</p>
        </div>
        <div class="border-4 border-black p-6 text-center" style="background-color: #FB923C; box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Pending</p>
            <p class="text-5xl font-black">{{ $pendingCount }}</p>
        </div>
        <div class="border-4 border-black p-6 text-center" style="background-color: #EC4899; box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Agents</p>
            <p class="text-5xl font-black">{{ $totalAgents }}</p>
        </div>
        <div class="border-4 border-black p-6 text-center" style="background-color: #DC2626; box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Customers</p>
            <p class="text-5xl font-black">{{ $totalCustomers }}</p>
        </div>
    </div>

    <!-- Latest Bookings -->
    <div class="border-4 border-black bg-white" style="box-shadow: 8px 8px 0 #000;">
        <div class="text-white border-b-4 border-black p-6" style="background-color: #3B82F6;">
            <h2 class="text-2xl font-black">Latest Bookings</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-4 border-black bg-gray-200">
                        <th class="px-6 py-4 text-left font-black">Tracking #</th>
                        <th class="px-6 py-4 text-left font-black">Route</th>
                        <th class="px-6 py-4 text-left font-black">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentShipments as $shipment)
                        <tr class="border-b-2 border-black hover:bg-gray-100">
                            <td class="px-6 py-4 font-bold">{{ $shipment->tracking_number }}</td>
                            <td class="px-6 py-4 font-bold">{{ $shipment->from_city }} → {{ $shipment->to_city }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-{{ match($shipment->status) {
                                    'delivered' => 'green',
                                    'in_transit' => 'cyan',
                                    'pending' => 'yellow',
                                    default => 'gray'
                                } }}-400 border-2 border-black font-bold text-sm uppercase">{{ $shipment->status }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center font-bold">No bookings yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection