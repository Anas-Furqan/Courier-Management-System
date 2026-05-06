@extends('layouts.app')

@section('page-title', 'Edit Shipment')

@section('content')
<div class="space-y-8 max-w-4xl">

    {{-- Hero --}}
    <div class="page-hero bg-yellow-300">
        <h1 class="text-4xl font-black mb-1">Update Shipment</h1>
        <p class="font-bold text-black/70">Edit shipment details for <span class="font-mono">{{ $shipment->tracking_number }}</span>.</p>
    </div>

    {{-- Form --}}
    <div class="neo-card-xl p-8 bg-white">
        <form method="POST" action="{{ route('couriers.update', $shipment->id) }}" class="grid gap-6 md:grid-cols-2">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Sender *</label>
                <select name="sender_id" class="neo-input">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @selected($customer->id == $shipment->sender_id)>
                            {{ $customer->name ?? $customer->company_name ?? 'Customer #'.$customer->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label">Receiver *</label>
                <select name="receiver_id" class="neo-input">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @selected($customer->id == $shipment->receiver_id)>
                            {{ $customer->name ?? $customer->company_name ?? 'Customer #'.$customer->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label">From City *</label>
                <input type="text" name="from_city" value="{{ $shipment->from_city }}" class="neo-input" {{ auth()->user()->isAgent() ? 'readonly' : '' }}>
            </div>

            <div>
                <label class="form-label">To City *</label>
                <select name="to_city" class="neo-input" required>
                    <option value="">Select a city...</option>
                    @foreach(['Karachi','Lahore','Islamabad','Rawalpindi','Faisalabad','Multan','Peshawar','Quetta'] as $city)
                        <option value="{{ $city }}" {{ $shipment->to_city === $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label">Courier Type *</label>
                <select name="courier_type" class="neo-input">
                    @foreach(['standard','express','overnight'] as $type)
                        <option value="{{ $type }}" @selected($shipment->courier_type === $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label">Weight (kg) *</label>
                <input type="number" step="0.01" name="weight" value="{{ $shipment->weight }}" class="neo-input">
            </div>

            <div>
                <label class="form-label">Price (PKR) *</label>
                <input type="number" step="0.01" name="price" value="{{ $shipment->price }}" class="neo-input">
            </div>

            <div>
                <label class="form-label">Expected Delivery *</label>
                <input type="date" name="expected_delivery_date" value="{{ optional($shipment->expected_delivery_date)->format('Y-m-d') }}" class="neo-input">
            </div>

            <div class="md:col-span-2 flex gap-4 pt-4 border-t-4 border-black">
                <button class="neo-btn flex-1 bg-yellow-300 text-black py-4" type="submit">Update Shipment</button>
                <a href="{{ route('couriers.show', $shipment->id) }}" class="neo-btn flex-1 bg-gray-200 text-black py-4 text-center">Cancel</a>
            </div>
        </form>
    </div>

</div>
@endsection
