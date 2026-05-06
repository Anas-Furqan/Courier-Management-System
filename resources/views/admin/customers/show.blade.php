@extends('layouts.app')

@section('page-title', 'Customer Details')

@section('content')
<div class="space-y-8 max-w-4xl">

    {{-- Hero --}}
    <div class="page-hero bg-pink-400">
        <p class="text-xs font-black uppercase tracking-widest mb-2 text-black/60">Customer Profile</p>
        <h1 class="text-4xl font-black mb-1">{{ $customer->company_name ?? $customer->user->name }}</h1>
        <p class="font-bold text-black/70">{{ $customer->address ?? 'Address not specified' }}</p>
    </div>

    {{-- Details Grid --}}
    <div class="grid gap-6 sm:grid-cols-2">
        <div class="info-card">
            <p class="info-label">Email Address</p>
            <p class="info-value break-words">{{ $customer->email }}</p>
        </div>

        <div class="info-card">
            <p class="info-label">Phone Number</p>
            <p class="info-value">{{ $customer->phone ?? 'N/A' }}</p>
        </div>

        <div class="info-card">
            <p class="info-label">City</p>
            <p class="info-value">{{ $customer->city }}</p>
        </div>

        <div class="info-card">
            <p class="info-label">Address</p>
            <p class="text-base font-bold">{{ $customer->address ?? 'Not specified' }}</p>
        </div>
    </div>

    {{-- Actions --}}
    <a href="{{ route('admin.customers.index') }}" class="neo-btn bg-gray-200 text-black inline-block">← Back to Customers</a>

</div>
@endsection
