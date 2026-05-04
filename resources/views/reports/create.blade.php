@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl space-y-6" data-reveal>
    <div class="hero-panel">
        <div>
            <p class="section-kicker">Generate Report</p>
            <h1 class="mt-3 text-4xl font-black text-white">Create shipment export</h1>
        </div>
    </div>

    <div class="glass-panel p-6">
        <form method="POST" action="{{ route(auth()->user()->isAdmin() ? 'admin.reports.store' : 'agent.reports.store') }}" class="grid gap-4 md:grid-cols-2">
            @csrf
            <div>
                <label class="input-label">Report Type</label>
                <select name="report_type" class="input-field">
                    <option value="shipment">Shipment</option>
                    <option value="city_wise">City Wise</option>
                    <option value="date_wise">Date Wise</option>
                </select>
            </div>
            <div>
                <label class="input-label">City</label>
                <input type="text" name="city" class="input-field">
            </div>
            <div>
                <label class="input-label">From Date</label>
                <input type="date" name="from_date" class="input-field">
            </div>
            <div>
                <label class="input-label">To Date</label>
                <input type="date" name="to_date" class="input-field">
            </div>
            <div class="md:col-span-2">
                <button class="btn-primary">Generate Export</button>
            </div>
        </form>
    </div>
</div>
@endsection