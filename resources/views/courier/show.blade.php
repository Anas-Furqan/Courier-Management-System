@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #8B5CF6, #A78BFA); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">{{ $shipment->tracking_number }}</h1>
        <p class="text-lg font-bold">Courier Details & Tracking</p>
        <div class="flex gap-4 mt-4 flex-wrap">
            <a href="{{ route('track.view', $shipment->tracking_number) }}" class="neo-btn px-4 py-2 bg-black text-white border-2 border-black" style="box-shadow: 4px 4px 0 0 #000;">Public View</a>
            <a href="{{ route('couriers.edit', $shipment->id) }}" class="neo-btn px-4 py-2 bg-yellow-300 border-2 border-black" style="box-shadow: 4px 4px 0 0 #000; color: black;">Edit</a>
            <a href="{{ route('track.print', $shipment->tracking_number) }}" class="neo-btn px-4 py-2 bg-blue-300 border-2 border-black" style="box-shadow: 4px 4px 0 0 #000; color: black;">Print</a>
        </div>
    </div>

    <!-- Route & Status Cards -->
    <div class="grid gap-6 md:grid-cols-2">
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2 uppercase">Route</p>
            <p class="text-2xl font-black">{{ $shipment->from_city }} → {{ $shipment->to_city }}</p>
        </div>
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2 uppercase">Status</p>
            <p class="text-2xl font-black" style="color: {{ $shipment->status === 'delivered' ? '#4ADE80' : ($shipment->status === 'in_transit' ? '#06B6D4' : '#FCD34D') }};">{{ str_replace('_', ' ', $shipment->status) }}</p>
        </div>
    </div>

    <!-- Shipment Details -->
    <div class="border-4 border-black bg-white p-8" style="box-shadow: 8px 8px 0 #000;">
        <h2 class="text-2xl font-black mb-6 border-b-4 border-black pb-3">Shipment Details</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-bold text-gray-600">From City</p>
                <p class="text-lg font-black">{{ $shipment->from_city }}</p>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-600">To City</p>
                <p class="text-lg font-black">{{ $shipment->to_city }}</p>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-600">Courier Type</p>
                <p class="text-lg font-black">{{ $shipment->courier_type ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-600">Weight</p>
                <p class="text-lg font-black">{{ $shipment->weight }} kg</p>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-600">Price</p>
                <p class="text-lg font-black">₹{{ $shipment->price }}</p>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-600">Booking Date</p>
                <p class="text-lg font-black">{{ $shipment->booking_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-600">Expected Delivery</p>
                <p class="text-lg font-black">{{ $shipment->expected_delivery_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-600">Actual Delivery</p>
                <p class="text-lg font-black">{{ $shipment->actual_delivery_date?->format('M d, Y') ?? 'Pending' }}</p>
            </div>
        </div>
    </div>

    <!-- Status Update Form -->
    @if($shipment->status !== 'delivered')
    <div class="border-4 border-black bg-white p-8" style="box-shadow: 8px 8px 0 #000;">
        <h2 class="text-2xl font-black mb-6 border-b-4 border-black pb-3">Update Status</h2>
        <form method="POST" action="{{ route('couriers.status', $shipment->id) }}" class="space-y-4">
            @csrf
            <div>
                <label class="block font-bold mb-2">New Status *</label>
                <select name="status" class="neo-input w-full" required>
                    <option value="">Select status...</option>
                    <option value="pending" @selected($shipment->status === 'pending')>Pending</option>
                    <option value="in_transit" @selected($shipment->status === 'in_transit')>In Transit</option>
                    <option value="delivered" @selected($shipment->status === 'delivered')>Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div>
                <label class="block font-bold mb-2">Current Location *</label>
                <input type="text" name="location" class="neo-input w-full" placeholder="e.g., Mumbai Warehouse" required>
            </div>
            <div>
                <label class="block font-bold mb-2">Notes</label>
                <textarea name="notes" class="neo-input w-full" rows="3" placeholder="Add any notes about this status update..."></textarea>
            </div>
            <button type="submit" class="neo-btn bg-blue-400 px-6 py-3 w-full">Update Status</button>
        </form>
    </div>
    @endif

    <!-- SMS Actions -->
    @if($shipment->sender || $shipment->receiver)
    <div class="border-4 border-black bg-white p-8" style="box-shadow: 8px 8px 0 #000;">
        <h2 class="text-2xl font-black mb-6 border-b-4 border-black pb-3">Send Notifications</h2>
        <div class="grid gap-4 md:grid-cols-2">
            @if($shipment->sender && $shipment->sender->phone)
            <form method="POST" action="{{ route('couriers.sms.from-to', $shipment->id) }}" class="inline">
                @csrf
                <button type="submit" class="neo-btn w-full bg-green-400 px-6 py-3">📱 Send Booking SMS to Sender</button>
            </form>
            @endif
            
            @if($shipment->receiver && $shipment->receiver->phone)
            <form method="POST" action="{{ route('couriers.sms.delivery', $shipment->id) }}" class="inline">
                @csrf
                <button type="submit" class="neo-btn w-full bg-purple-400 px-6 py-3">📱 Send Delivery SMS to Receiver</button>
            </form>
            @endif
        </div>
        <p class="text-sm font-bold text-gray-600 mt-4">Note: SMS messages will be logged in the system for delivery tracking purposes.</p>
    </div>
    @endif

    <!-- Tracking Timeline -->
    <div class="border-4 border-black bg-white" style="box-shadow: 8px 8px 0 #000;">
        <div class="text-white border-b-4 border-black p-6" style="background-color: #8B5CF6;">
            <h2 class="text-2xl font-black">Tracking Timeline</h2>
        </div>
        <div class="p-8 space-y-4">
            @forelse($shipment->tracking as $track)
                <div class="border-l-4 border-black pl-6 pb-4">
                    <p class="font-black text-lg">{{ $track->status }} • {{ $track->location }}</p>
                    <p class="font-bold text-gray-600 text-sm mt-1">{{ $track->notes }}</p>
                    <p class="font-bold text-gray-400 text-xs mt-1">{{ $track->created_at?->format('M d, Y H:i') }}</p>
                </div>
            @empty
                <p class="font-bold text-gray-600 text-center py-8">No tracking history available.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection