@extends('layouts.app')

@section('page-title', 'Shipment Detail')

@section('content')
<div class="space-y-8 max-w-4xl">

    {{-- Hero --}}
    <div class="page-hero bg-violet-400 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <div>
            <p class="text-xs font-black uppercase tracking-widest mb-2 text-black/60">Tracking Number</p>
            <h1 class="text-3xl font-black font-mono mb-1">{{ $shipment->tracking_number }}</h1>
            <p class="font-bold text-black/70">Courier Details &amp; Tracking</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('track.view', $shipment->tracking_number) }}" class="neo-btn-sm bg-black text-white">Public View</a>
            <a href="{{ route('couriers.edit', $shipment->id) }}" class="neo-btn-sm bg-yellow-300 text-black">Edit</a>
            <a href="{{ route('track.print', $shipment->tracking_number) }}" class="neo-btn-sm bg-blue-300 text-black">Print</a>
        </div>
    </div>

    {{-- Route & Status --}}
    <div class="grid gap-6 md:grid-cols-2">
        <div class="info-card">
            <p class="info-label">Route</p>
            <p class="info-value">{{ $shipment->from_city }} → {{ $shipment->to_city }}</p>
        </div>
        <div class="info-card">
            <p class="info-label">Current Status</p>
            <span class="s-{{ $shipment->status }} mt-1 inline-block text-sm">{{ str_replace('_',' ',$shipment->status) }}</span>
        </div>
    </div>

    {{-- Shipment Details --}}
    <div class="neo-card-xl bg-white">
        <div class="p-6 border-b-4 border-black">
            <h2 class="text-xl font-black">Shipment Details</h2>
        </div>
        <div class="p-6 grid grid-cols-2 md:grid-cols-4 gap-6">
            <div>
                <p class="info-label">Courier Type</p>
                <p class="font-black">{{ ucfirst($shipment->courier_type ?? 'N/A') }}</p>
            </div>
            <div>
                <p class="info-label">Weight</p>
                <p class="font-black">{{ $shipment->weight }} kg</p>
            </div>
            <div>
                <p class="info-label">Price</p>
                <p class="font-black">Rs. {{ number_format($shipment->price, 2) }}</p>
            </div>
            <div>
                <p class="info-label">Booking Date</p>
                <p class="font-black">{{ $shipment->booking_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="info-label">Expected Delivery</p>
                <p class="font-black">{{ $shipment->expected_delivery_date?->format('M d, Y') ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="info-label">Actual Delivery</p>
                <p class="font-black">{{ $shipment->actual_delivery_date?->format('M d, Y') ?? 'Pending' }}</p>
            </div>
        </div>
    </div>

    {{-- Status Update --}}
    @if($shipment->status !== 'delivered')
    <div class="neo-card-xl bg-white">
        <div class="p-6 border-b-4 border-black">
            <h2 class="text-xl font-black">Update Status</h2>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('couriers.status', $shipment->id) }}" class="space-y-4">
                @csrf
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="form-label">New Status *</label>
                        <select name="status" class="neo-input" required>
                            <option value="">Select status...</option>
                            <option value="pending"    @selected($shipment->status === 'pending')>Pending</option>
                            <option value="in_transit" @selected($shipment->status === 'in_transit')>In Transit</option>
                            <option value="delivered"  @selected($shipment->status === 'delivered')>Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Current Location *</label>
                        <input type="text" name="location" class="neo-input" placeholder="e.g., Karachi Warehouse" required>
                    </div>
                </div>
                <div>
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="neo-input" rows="3" placeholder="Add any notes about this status update..."></textarea>
                </div>
                <button type="submit" class="neo-btn bg-blue-500 text-white w-full py-3">Update Status</button>
            </form>
        </div>
    </div>
    @endif

    {{-- SMS Notifications --}}
    @if($shipment->sender || $shipment->receiver)
    <div class="neo-card-xl bg-white">
        <div class="p-6 border-b-4 border-black">
            <h2 class="text-xl font-black">Send Notifications</h2>
        </div>
        <div class="p-6">
            <div class="grid gap-4 md:grid-cols-2">
                @if($shipment->sender && $shipment->sender->phone)
                <form method="POST" action="{{ route('couriers.sms.from-to', $shipment->id) }}">
                    @csrf
                    <button type="submit" class="neo-btn w-full bg-green-400 text-black py-3">📱 SMS to Sender</button>
                </form>
                @endif

                @if($shipment->receiver && $shipment->receiver->phone)
                <form method="POST" action="{{ route('couriers.sms.delivery', $shipment->id) }}">
                    @csrf
                    <button type="submit" class="neo-btn w-full bg-purple-400 text-black py-3">📱 SMS to Receiver</button>
                </form>
                @endif
            </div>
            <p class="text-xs font-bold text-gray-500 mt-4">SMS messages will be logged in the system for delivery tracking.</p>
        </div>
    </div>
    @endif

    {{-- Tracking Timeline --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-violet-500 text-white border-b-4 border-black">
            <h2 class="text-xl font-black">Tracking Timeline</h2>
        </div>
        <div class="p-8">
            @forelse($shipment->tracking as $track)
                <div class="track-event">
                    <p class="font-black text-base">{{ ucfirst(str_replace('_',' ',$track->status)) }} — {{ $track->location }}</p>
                    @if($track->notes)
                        <p class="font-bold text-sm text-gray-600 mt-1">{{ $track->notes }}</p>
                    @endif
                    <p class="text-xs font-bold text-gray-400 mt-1">{{ $track->created_at?->format('M d, Y H:i') }}</p>
                </div>
            @empty
                <p class="text-center py-8 font-bold text-gray-500">No tracking history available yet.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
