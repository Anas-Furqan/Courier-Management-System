@extends('layouts.app')

@section('page-title', 'Customer Details')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #EC4899, #F472B6); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">{{ $customer->company_name ?? $customer->user->name }}</h1>
        <p class="text-lg font-bold">{{ $customer->address ?? 'Address not specified' }}</p>
    </div>

    <!-- Details Grid -->
    <div class="grid gap-6 sm:grid-cols-2">
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2">EMAIL ADDRESS</p>
            <p class="text-2xl font-black break-words">{{ $customer->email }}</p>
        </div>
        
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2">PHONE NUMBER</p>
            <p class="text-2xl font-black">{{ $customer->phone ?? 'N/A' }}</p>
        </div>
        
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2">CITY</p>
            <p class="text-2xl font-black">{{ $customer->city }}</p>
        </div>
        
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2">ADDRESS</p>
            <p class="text-xl font-bold">{{ $customer->address ?? 'Not specified' }}</p>
        </div>
    </div>

    <!-- Action Button -->
    <a href="{{ route('admin.customers.index') }}" class="neo-btn px-6 py-3 inline-block" style="background-color: #E5E7EB; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: black;">Back to Customers</a>
</div>
@endsection
