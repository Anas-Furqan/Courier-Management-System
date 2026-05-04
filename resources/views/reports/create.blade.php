@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #EF4444, #DC2626); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">Generate Report</h1>
        <p class="text-lg font-bold">Create a shipment export with custom filters.</p>
    </div>

    <!-- Form Card -->
    <div class="border-4 border-black bg-white p-8" style="box-shadow: 8px 8px 0 #000;">
        <form method="POST" action="{{ route(auth()->user()->isAdmin() ? 'admin.reports.store' : 'agent.reports.store') }}" class="grid gap-6 md:grid-cols-2">
            @csrf
            
            <div>
                <label class="block font-bold mb-3">Report Type *</label>
                <select name="report_type" class="neo-input w-full">
                    <option value="shipment">Shipment</option>
                    <option value="city_wise">City Wise</option>
                    <option value="date_wise">Date Wise</option>
                </select>
            </div>
            
            <div>
                <label class="block font-bold mb-3">City</label>
                <input type="text" name="city" class="neo-input w-full" placeholder="e.g., Mumbai">
            </div>
            
            <div>
                <label class="block font-bold mb-3">From Date</label>
                <input type="date" name="from_date" class="neo-input w-full">
            </div>
            
            <div>
                <label class="block font-bold mb-3">To Date</label>
                <input type="date" name="to_date" class="neo-input w-full">
            </div>
            
            <div class="md:col-span-2 flex gap-4">
                <button class="neo-btn px-6 py-3 flex-1" type="submit" style="background-color: #EF4444; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: white;">Generate Export</button>
                <a href="{{ route('admin.reports.index') }}" class="neo-btn px-6 py-3 text-center flex-1" style="background-color: #E5E7EB; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: black;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection