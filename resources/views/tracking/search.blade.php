@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl space-y-6" data-reveal>
    <section class="hero-panel">
        <div>
            <p class="section-kicker">Track Shipment</p>
            <h1 class="mt-3 text-4xl font-black text-white">Search by tracking number</h1>
        </div>
    </section>

    <form method="GET" action="{{ url('/track') }}" class="glass-panel flex flex-col gap-4 p-6 sm:flex-row">
        <input type="text" name="tracking_number" class="input-field flex-1" placeholder="Enter tracking number">
        <button class="btn-primary sm:w-auto">Search</button>
    </form>
</div>
@endsection