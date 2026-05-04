@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #3B82F6, #2563EB); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">Create New Shipment</h1>
        <p class="text-lg font-bold">Fill in the shipment details to create a new courier booking.</p>
    </div>

    <!-- Form Card -->
    <div class="border-4 border-black bg-white p-8" style="box-shadow: 8px 8px 0 #000;">
        <form method="POST" action="{{ route('couriers.store') }}" class="space-y-8">
            @csrf
            
            <!-- Sender & Receiver Section -->
            <div>
                <h3 class="text-2xl font-black mb-6 border-b-4 border-black pb-3">Shipment Parties</h3>
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block font-bold mb-3">From (Sender) *</label>
                        <select name="sender_id" class="neo-input w-full" required>
                            <option value="">Select sender...</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->company_name ?? $customer->name ?? 'Customer #'.$customer->id }}</option>
                            @endforeach
                        </select>
                        @error('sender_id')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block font-bold mb-3">To (Receiver) *</label>
                        <select name="receiver_id" class="neo-input w-full" required>
                            <option value="">Select receiver...</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->company_name ?? $customer->name ?? 'Customer #'.$customer->id }}</option>
                            @endforeach
                        </select>
                        @error('receiver_id')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Route Section -->
            <div>
                <h3 class="text-2xl font-black mb-6 border-b-4 border-black pb-3">Route Details</h3>
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block font-bold mb-3">From City *</label>
                        <input type="text" name="from_city" value="{{ auth()->user()->isAgent() ? ($agent->branch_city ?? old('from_city')) : old('from_city') }}" class="neo-input w-full" {{ auth()->user()->isAgent() ? 'readonly' : '' }} required>
                        @error('from_city')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block font-bold mb-3">To City *</label>
                        <input type="text" name="to_city" value="{{ old('to_city') }}" class="neo-input w-full" placeholder="e.g., Mumbai" required>
                        @error('to_city')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Courier Details Section -->
            <div>
                <h3 class="text-2xl font-black mb-6 border-b-4 border-black pb-3">Shipment Details</h3>
                <div class="grid gap-6 md:grid-cols-3">
                    <div>
                        <label class="block font-bold mb-3">Courier Type *</label>
                        <select name="courier_type" class="neo-input w-full" required>
                            <option value="standard">Standard</option>
                            <option value="express">Express</option>
                            <option value="overnight">Overnight</option>
                        </select>
                        @error('courier_type')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block font-bold mb-3">Weight (kg) *</label>
                        <input type="number" step="0.01" name="weight" value="{{ old('weight') }}" class="neo-input w-full" placeholder="0.00" required>
                        @error('weight')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block font-bold mb-3">Price (₹) *</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="neo-input w-full" placeholder="0.00" required>
                        @error('price')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Dates Section -->
            <div>
                <h3 class="text-2xl font-black mb-6 border-b-4 border-black pb-3">Timeline</h3>
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block font-bold mb-3">Booking Date *</label>
                        <input type="date" name="booking_date" value="{{ old('booking_date') }}" class="neo-input w-full" required>
                        @error('booking_date')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block font-bold mb-3">Expected Delivery *</label>
                        <input type="date" name="expected_delivery_date" value="{{ old('expected_delivery_date') }}" class="neo-input w-full" required>
                        @error('expected_delivery_date')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-4 pt-6 border-t-4 border-black">
                <button type="submit" class="neo-btn px-6 py-3 flex-1" style="background-color: #3B82F6; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: white;">Create Shipment</button>
                <a href="{{ route('couriers.index') }}" class="neo-btn px-6 py-3 text-center flex-1" style="background-color: #E5E7EB; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: black;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection