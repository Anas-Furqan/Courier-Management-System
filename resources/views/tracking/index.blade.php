@extends('layouts.master')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-16 space-y-8">

    {{-- Hero --}}
    <div class="page-hero bg-blue-500 text-white text-center">
        <h1 class="text-5xl font-black mb-3">Track Your Shipment</h1>
        <p class="font-bold text-white/80 text-lg">Enter your tracking number for live updates on location and delivery status.</p>
    </div>

    {{-- Search Form --}}
    <div class="neo-card-xl p-8 bg-white">
        <form class="space-y-5" action="#" method="GET"
              onsubmit="event.preventDefault(); const v = this.querySelector('input').value.trim(); if(v) { window.location.href = '{{ url('/track') }}/' + encodeURIComponent(v); }">
            <div>
                <label class="form-label">Tracking Number *</label>
                <input class="neo-input text-lg py-4" type="text" placeholder="e.g., DI-2024-001234" aria-label="Tracking number" required>
                <p class="text-sm font-bold text-gray-500 mt-2">Found on your shipment receipt or SMS notification.</p>
            </div>
            <button class="neo-btn w-full bg-blue-500 text-white py-4 text-base" type="submit">Track Shipment</button>
        </form>

        <div class="mt-8 pt-6 border-t-4 border-black space-y-3">
            <p class="font-black text-xs uppercase tracking-widest text-gray-500">Need Help?</p>
            <ul class="space-y-2 font-bold text-sm text-gray-700">
                <li class="flex gap-2"><span class="text-cyan-600 font-black">→</span> Tracking numbers start with <span class="font-mono font-black">DI-</span></li>
                <li class="flex gap-2"><span class="text-cyan-600 font-black">→</span> You'll receive tracking details via SMS</li>
                <li class="flex gap-2"><span class="text-cyan-600 font-black">→</span> Updates are available 24/7 from booking to delivery</li>
            </ul>
        </div>
    </div>

</div>
@endsection
