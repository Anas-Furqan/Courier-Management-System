@extends('layouts.app')

@section('page-title', 'My Shipments')

@section('content')
<div class="space-y-8">

    {{-- Hero --}}
    <div class="page-hero bg-pink-400 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-black mb-1">My Shipments</h1>
            <p class="font-bold text-black/70">View your full shipment history and track packages.</p>
        </div>
        <a href="{{ url('/track') }}" class="neo-btn bg-black text-white flex-shrink-0">+ Track Another</a>
    </div>

    {{-- Table --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-pink-500 text-white border-b-4 border-black">
            <h2 class="text-2xl font-black">Shipment History ({{ count($shipments ?? []) }})</h2>
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
                    @forelse($shipments as $shipment)
                        <tr>
                            <td class="font-mono font-black">{{ $shipment->tracking_number }}</td>
                            <td>{{ $shipment->from_city }} → {{ $shipment->to_city }}</td>
                            <td>
                                <span class="s-{{ $shipment->status }}">{{ str_replace('_',' ',$shipment->status) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-12 text-gray-500">No shipments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
