@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl space-y-8" data-reveal>
    <div class="hero-panel">
        <div>
            <p class="section-kicker">Add Shipment</p>
            <h1 class="mt-3 text-4xl font-black text-white">Create New Shipment</h1>
            <p class="mt-3 max-w-2xl text-slate-300">Fill in the shipment details to create a new courier booking.</p>
        </div>
    </div>

    <div class="glass-panel p-8">
        <form method="POST" action="{{ route('couriers.store') }}" class="space-y-8">
            @csrf
            
            <!-- Sender & Receiver Section -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Shipment Parties</h3>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="input-label">From (Sender)</label>
                        <select name="sender_id" class="input-field" required>
                            <option value="">Select sender...</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->company_name ?? $customer->name ?? 'Customer #'.$customer->id }}</option>
                            @endforeach
                        </select>
                        @error('sender_id')<span class="text-rose-400 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="input-label">To (Receiver)</label>
                        <select name="receiver_id" class="input-field" required>
                            <option value="">Select receiver...</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->company_name ?? $customer->name ?? 'Customer #'.$customer->id }}</option>
                            @endforeach
                        </select>
                        @error('receiver_id')<span class="text-rose-400 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Route Section -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Route Details</h3>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="input-label">From City</label>
                        <input type="text" name="from_city" value="{{ auth()->user()->isAgent() ? ($agent->branch_city ?? old('from_city')) : old('from_city') }}" class="input-field" {{ auth()->user()->isAgent() ? 'readonly' : '' }} required>
                        @error('from_city')<span class="text-rose-400 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="input-label">To City</label>
                        <input type="text" name="to_city" value="{{ old('to_city') }}" class="input-field" placeholder="e.g., Mumbai" required>
                        @error('to_city')<span class="text-rose-400 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Courier Details Section -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Shipment Details</h3>
                <div class="grid gap-4 md:grid-cols-3">
                    <div>
                        <label class="input-label">Courier Type</label>
                        <select name="courier_type" class="input-field" required>
                            <option value="standard">Standard</option>
                            <option value="express">Express</option>
                            <option value="overnight">Overnight</option>
                        </select>
                        @error('courier_type')<span class="text-rose-400 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="input-label">Weight (kg)</label>
                        <input type="number" step="0.01" name="weight" value="{{ old('weight') }}" class="input-field" placeholder="0.00" required>
                        @error('weight')<span class="text-rose-400 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="input-label">Price (₹)</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="input-field" placeholder="0.00" required>
                        @error('price')<span class="text-rose-400 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Dates Section -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Timeline</h3>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="input-label">Booking Date</label>
                        <input type="date" name="booking_date" value="{{ old('booking_date') }}" class="input-field" required>
                        @error('booking_date')<span class="text-rose-400 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="input-label">Expected Delivery</label>
                        <input type="date" name="expected_delivery_date" value="{{ old('expected_delivery_date') }}" class="input-field" required>
                        @error('expected_delivery_date')<span class="text-rose-400 text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3 pt-6 border-t border-white/10">
                <button type="submit" class="btn-primary">Create Shipment</button>
                <a href="{{ route('couriers.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection