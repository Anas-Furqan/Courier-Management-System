@extends('layouts.app')

@section('page-title', 'New Shipment')

@section('content')
<div class="space-y-8 max-w-4xl">

    {{-- Hero --}}
    <div class="page-hero bg-blue-500 text-white">
        <h1 class="text-4xl font-black mb-1">Create New Shipment</h1>
        <p class="font-bold text-white/80">Fill in the shipment details to create a new courier booking.</p>
    </div>

    {{-- Form --}}
    <div class="neo-card-xl p-8 bg-white">
        @php
            $storeRoute = auth()->user()->isAdmin() ? 'couriers.store' : 'agent.couriers.store';
        @endphp
        <form method="POST" action="{{ route($storeRoute) }}" class="space-y-8">
            @csrf

            {{-- Parties --}}
            <div>
                <h3 class="section-title">Shipment Parties</h3>
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="form-label">From (Sender) *</label>
                        <select name="sender_id" class="neo-input" required>
                            <option value="">Select sender...</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('sender_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->company_name ?? $customer->name ?? 'Customer #'.$customer->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('sender_id')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">To (Receiver) *</label>
                        <select name="receiver_id" class="neo-input" required>
                            <option value="">Select receiver...</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('receiver_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->company_name ?? $customer->name ?? 'Customer #'.$customer->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('receiver_id')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Route --}}
            <div>
                <h3 class="section-title">Route Details</h3>
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="form-label">From City *</label>
                        <input type="text" name="from_city"
                            value="{{ auth()->user()->isAgent() ? ($agent->branch_city ?? old('from_city')) : old('from_city') }}"
                            class="neo-input"
                            {{ auth()->user()->isAgent() ? 'readonly' : '' }}
                            required>
                        @error('from_city')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">To City *</label>
                        <select name="to_city" class="neo-input" required>
                            <option value="">Select destination...</option>
                            @foreach(['Karachi','Lahore','Islamabad','Rawalpindi','Faisalabad','Multan','Peshawar','Quetta'] as $city)
                                <option value="{{ $city }}" {{ old('to_city') === $city ? 'selected' : '' }}>{{ $city }}</option>
                            @endforeach
                        </select>
                        @error('to_city')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Shipment Details --}}
            <div>
                <h3 class="section-title">Shipment Details</h3>
                <div class="grid gap-6 md:grid-cols-3">
                    <div>
                        <label class="form-label">Courier Type *</label>
                        <select name="courier_type" class="neo-input" required>
                            <option value="standard" {{ old('courier_type') === 'standard' ? 'selected' : '' }}>Standard</option>
                            <option value="express"  {{ old('courier_type') === 'express'  ? 'selected' : '' }}>Express</option>
                            <option value="overnight"{{ old('courier_type') === 'overnight'? 'selected' : '' }}>Overnight</option>
                        </select>
                        @error('courier_type')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">Weight (kg) *</label>
                        <input type="number" step="0.01" name="weight" value="{{ old('weight') }}" class="neo-input" placeholder="0.00" required>
                        @error('weight')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">Price (PKR) *</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="neo-input" placeholder="0.00" required>
                        @error('price')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Timeline --}}
            <div>
                <h3 class="section-title">Timeline</h3>
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="form-label">Booking Date *</label>
                        <input type="date" name="booking_date" value="{{ old('booking_date') }}" class="neo-input" required>
                        @error('booking_date')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">Expected Delivery *</label>
                        <input type="date" name="expected_delivery_date" value="{{ old('expected_delivery_date') }}" class="neo-input" required>
                        @error('expected_delivery_date')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex gap-4 pt-4 border-t-4 border-black">
                <button type="submit" class="neo-btn flex-1 bg-blue-500 text-white py-4">Create Shipment</button>
                @php
                    $indexRoute = auth()->user()->isAdmin() ? 'couriers.index' : 'agent.couriers.index';
                @endphp
                <a href="{{ route($indexRoute) }}" class="neo-btn flex-1 bg-gray-200 text-black py-4 text-center">Cancel</a>
            </div>
        </form>
    </div>

</div>
@endsection
