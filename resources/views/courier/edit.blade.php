@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #F59E0B, #FBBF24); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">Update Shipment</h1>
        <p class="text-lg font-bold">Edit shipment details and tracking information.</p>
    </div>

    <!-- Form Card -->
    <div class="border-4 border-black bg-white p-8" style="box-shadow: 8px 8px 0 #000;">
        <form method="POST" action="{{ route('couriers.update', $shipment->id) }}" class="grid gap-6 md:grid-cols-2">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block font-bold mb-3">Sender *</label>
                <select name="sender_id" class="neo-input w-full">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @selected($customer->id == $shipment->sender_id)>{{ $customer->name ?? $customer->company_name ?? ('Customer #'.$customer->id) }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Receiver *</label>
                <select name="receiver_id" class="neo-input w-full">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @selected($customer->id == $shipment->receiver_id)>{{ $customer->name ?? $customer->company_name ?? ('Customer #'.$customer->id) }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block font-bold mb-3">From City *</label>
                <input type="text" name="from_city" value="{{ $shipment->from_city }}" class="neo-input w-full" {{ auth()->user()->isAgent() ? 'readonly' : '' }}>
            </div>
            
            <div>
                <label class="block font-bold mb-3">To City *</label>
                <input type="text" name="to_city" value="{{ $shipment->to_city }}" class="neo-input w-full">
            </div>
            
            <div>
                <label class="block font-bold mb-3">Courier Type *</label>
                <select name="courier_type" class="neo-input w-full">
                    @foreach(['standard','express','overnight'] as $type)
                        <option value="{{ $type }}" @selected($shipment->courier_type === $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Weight (kg) *</label>
                <input type="number" step="0.01" name="weight" value="{{ $shipment->weight }}" class="neo-input w-full">
            </div>
            
            <div>
                <label class="block font-bold mb-3">Price (₹) *</label>
                <input type="number" step="0.01" name="price" value="{{ $shipment->price }}" class="neo-input w-full">
            </div>
            
            <div>
                <label class="block font-bold mb-3">Expected Delivery *</label>
                <input type="date" name="expected_delivery_date" value="{{ optional($shipment->expected_delivery_date)->format('Y-m-d') }}" class="neo-input w-full">
            </div>
            
            <div class="md:col-span-2 flex gap-4">
                <button class="neo-btn px-6 py-3 flex-1" type="submit" style="background-color: #F59E0B; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: black;">Update Shipment</button>
                <a href="{{ route('couriers.show', $shipment->id) }}" class="neo-btn px-6 py-3 text-center flex-1" style="background-color: #E5E7EB; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: black;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection