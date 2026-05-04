@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8 text-center" style="background: linear-gradient(to right, #06B6D4, #0891B2); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">Search by Tracking Number</h1>
        <p class="text-lg font-bold">Find and track any shipment in the system.</p>
    </div>

    <!-- Search Form -->
    <div class="border-4 border-black bg-white p-8" style="box-shadow: 8px 8px 0 #000;">
        <form method="GET" action="{{ url('/track') }}" class="flex flex-col gap-6 sm:flex-row">
            <input type="text" name="tracking_number" class="neo-input flex-1" placeholder="Enter tracking number..." required>
            <button class="neo-btn px-8 py-3 bg-cyan-400 border-2 border-black font-bold" style="box-shadow: 6px 6px 0 0 #000; color: black;">Search</button>
        </form>
    </div>
</div>
@endsection