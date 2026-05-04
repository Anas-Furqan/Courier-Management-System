@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl space-y-6" data-reveal>
    <div class="hero-panel">
        <div>
            <p class="section-kicker">Edit Courier</p>
            <h1 class="mt-3 text-4xl font-black text-white">Update shipment</h1>
        </div>
    </div>

    <div class="glass-panel p-6">
        <form method="POST" action="{{ route('couriers.update', $shipment->id) }}" class="grid gap-4 md:grid-cols-2">
            @csrf
            @method('PUT')
            <div>
                <label class="input-label">Sender</label>
                <select name="sender_id" class="input-field">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @selected($customer->id == $shipment->sender_id)>{{ $customer->name ?? $customer->company_name ?? ('Customer #'.$customer->id) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="input-label">Receiver</label>
                <select name="receiver_id" class="input-field">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @selected($customer->id == $shipment->receiver_id)>{{ $customer->name ?? $customer->company_name ?? ('Customer #'.$customer->id) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="input-label">From City</label>
                <input type="text" name="from_city" value="{{ $shipment->from_city }}" class="input-field" {{ auth()->user()->isAgent() ? 'readonly' : '' }}>
            </div>
            <div>
                <label class="input-label">To City</label>
                <input type="text" name="to_city" value="{{ $shipment->to_city }}" class="input-field">
            </div>
            <div>
                <label class="input-label">Courier Type</label>
                <select name="courier_type" class="input-field">
                    @foreach(['standard','express','overnight'] as $type)
                        <option value="{{ $type }}" @selected($shipment->courier_type === $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="input-label">Weight</label>
                <input type="number" step="0.01" name="weight" value="{{ $shipment->weight }}" class="input-field">
            </div>
            <div>
                <label class="input-label">Price</label>
                <input type="number" step="0.01" name="price" value="{{ $shipment->price }}" class="input-field">
            </div>
            <div>
                <label class="input-label">Expected Delivery</label>
                <input type="date" name="expected_delivery_date" value="{{ optional($shipment->expected_delivery_date)->format('Y-m-d') }}" class="input-field">
            </div>
            <div class="md:col-span-2">
                <button class="btn-primary">Update Courier</button>
            </div>
        </form>
    </div>
</div>
@endsection