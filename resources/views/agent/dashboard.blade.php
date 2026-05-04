@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8 flex justify-between items-center" style="background: linear-gradient(to right, #4ADE80, #10B981); box-shadow: 8px 8px 0 #000;">
        <div>
            <h1 class="text-4xl font-black mb-2">{{ $agent->branch_city }} Operations</h1>
            <p class="text-lg font-bold">Manage and track all shipments for your branch with real-time updates.</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('couriers.create') }}" class="neo-btn bg-black text-white px-6 py-3">+ Add Shipment</a>
            <a href="{{ route('couriers.index') }}" class="neo-btn bg-white text-black px-6 py-3">View All</a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="border-4 border-black p-6 text-center" style="background-color: #FCD34D; box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Total</p>
            <p class="text-5xl font-black">{{ $totalShipments }}</p>
        </div>
        <div class="border-4 border-black p-6 text-center" style="background-color: #4ADE80; box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Delivered</p>
            <p class="text-5xl font-black">{{ $deliveredCount }}</p>
        </div>
        <div class="border-4 border-black p-6 text-center" style="background-color: #06B6D4; box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">In Transit</p>
            <p class="text-5xl font-black">{{ $inTransitCount }}</p>
        </div>
        <div class="border-4 border-black p-6 text-center" style="background-color: #FB923C; box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-black uppercase mb-2">Pending</p>
            <p class="text-5xl font-black">{{ $pendingCount ?? 0 }}</p>
        </div>
    </div>

    <!-- Recent Shipments -->
    <div class="border-4 border-black bg-white" style="box-shadow: 8px 8px 0 #000;">
        <div class="bg-red-500 text-white border-b-4 border-black p-6">
            <h2 class="text-2xl font-black">Recent Shipments</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-4 border-black bg-gray-200">
                        <th class="px-6 py-4 text-left font-black">Tracking #</th>
                        <th class="px-6 py-4 text-left font-black">Route</th>
                        <th class="px-6 py-4 text-left font-black">Status</th>
                        <th class="px-6 py-4 text-left font-black">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentShipments ?? [] as $shipment)
                        <tr class="border-b-2 border-black hover:bg-gray-100">
                            <td class="px-6 py-4 font-bold">{{ $shipment->tracking_number ?? 'N/A' }}</td>
                            <td class="px-6 py-4 font-bold">{{ $shipment->from_city ?? 'N/A' }} → {{ $shipment->to_city ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-400 border-2 border-black font-bold text-sm uppercase">{{ $shipment->status ?? 'pending' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('couriers.show', $shipment->id ?? 0) }}" class="px-3 py-1 bg-green-400 border-2 border-black font-bold text-sm">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center font-bold">No shipments yet. Create your first shipment to get started.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
        </div>
    </section>
</div>
@endsection