@extends('layouts.app')

@section('page-title', 'Track Shipment')

@section('content')
<div class="max-w-2xl mx-auto space-y-8">

    {{-- Hero --}}
    <div class="page-hero bg-cyan-400 text-center">
        <h1 class="text-4xl font-black mb-2">Track a Shipment</h1>
        <p class="font-bold text-black/70">Enter your tracking number to get live status updates.</p>
    </div>

    {{-- Search Form --}}
    <div class="neo-card-xl p-8 bg-white">
        <form method="GET" action="{{ url('/track') }}" class="space-y-4">
            <label class="form-label">Tracking Number</label>
            <div class="flex flex-col sm:flex-row gap-4">
                <input type="text" name="tracking_number" class="neo-input flex-1" placeholder="e.g., DI-2024-001234" required>
                <button class="neo-btn bg-cyan-400 text-black px-8 flex-shrink-0">Search</button>
            </div>
        </form>
    </div>

    {{-- Tip --}}
    <div class="border-4 border-black p-5 bg-yellow-50">
        <p class="font-black text-sm mb-1">💡 Where to find your tracking number?</p>
        <p class="font-bold text-sm text-gray-700">Your tracking number was provided when the shipment was booked. It starts with <span class="font-mono font-black">DI-</span> followed by the year and a unique number.</p>
    </div>

</div>
@endsection
