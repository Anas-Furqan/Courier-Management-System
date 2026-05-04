@extends('layouts.guest')

@section('content')
<div class="max-w-2xl mx-auto space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-12 text-center" style="background: linear-gradient(to right, #3B82F6, #2563EB); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-5xl font-black mb-2">Track Your Shipment</h1>
        <p class="text-lg font-bold">Enter your tracking number to get live updates on your package location and delivery status.</p>
    </div>

    <!-- Search Form -->
    <div class="border-4 border-black bg-white p-8" style="box-shadow: 8px 8px 0 #000;">
        <form class="space-y-6" action="#" method="GET" onsubmit="event.preventDefault(); const value = this.querySelector('input').value.trim(); if (value) { window.location.href = '{{ url('/track') }}/' + encodeURIComponent(value); }">
            <div>
                <label class="block font-bold mb-3">Tracking Number *</label>
                <input class="neo-input w-full text-lg py-4" type="text" placeholder="e.g., CMS202605040001" aria-label="Tracking number" required>
                <p class="text-sm font-bold text-gray-600 mt-3">You'll find this number on your shipment receipt or SMS notification.</p>
            </div>
            <button class="neo-btn w-full py-4 font-black text-lg" type="submit" style="background-color: #3B82F6; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: white;">Track Shipment</button>
        </form>

        <div class="mt-8 pt-8 border-t-4 border-black">
            <p class="text-sm font-bold text-gray-600 mb-6 uppercase tracking-wider">Need Help?</p>
            <ul class="space-y-4 text-gray-700">
                <li class="flex gap-4">
                    <span class="text-2xl font-black" style="color: #06B6D4;">•</span>
                    <span class="font-bold">Tracking numbers start with <span class="font-mono">CMS</span> followed by a 12-digit code</span>
                </li>
                <li class="flex gap-4">
                    <span class="text-2xl font-black" style="color: #06B6D4;">•</span>
                    <span class="font-bold">You'll receive tracking details via SMS and email</span>
                </li>
                <li class="flex gap-4">
                    <span class="text-2xl font-black" style="color: #06B6D4;">•</span>
                    <span class="font-bold">Updates are available 24/7 from booking to delivery</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
