@extends('layouts.app')

@section('page-title', 'Generate Report')

@section('content')
<div class="space-y-8 max-w-3xl">

    {{-- Hero --}}
    <div class="page-hero bg-red-400 text-white">
        <h1 class="text-4xl font-black mb-1">Generate Report</h1>
        <p class="font-bold text-white/80">Create a shipment export with custom filters.</p>
    </div>

    {{-- Form --}}
    <div class="neo-card-xl p-8 bg-white">
        <form method="POST" action="{{ route(auth()->user()->isAdmin() ? 'admin.reports.store' : 'agent.reports.store') }}"
              class="grid gap-6 md:grid-cols-2">
            @csrf

            <div>
                <label class="form-label">Report Type *</label>
                <select name="report_type" class="neo-input">
                    <option value="shipment">Shipment</option>
                    <option value="city_wise">City Wise</option>
                    <option value="date_wise">Date Wise</option>
                </select>
            </div>

            <div>
                <label class="form-label">City <span class="font-bold normal-case text-gray-500 text-xs">(optional)</span></label>
                <select name="city" class="neo-input">
                    <option value="">All Cities</option>
                    @foreach(['Karachi','Lahore','Islamabad','Rawalpindi','Faisalabad','Multan','Peshawar','Quetta'] as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label">From Date</label>
                <input type="date" name="from_date" class="neo-input">
            </div>

            <div>
                <label class="form-label">To Date</label>
                <input type="date" name="to_date" class="neo-input">
            </div>

            <div class="md:col-span-2 flex gap-4 pt-4 border-t-4 border-black">
                <button class="neo-btn flex-1 bg-red-500 text-white py-4" type="submit">Generate Export</button>
                <a href="{{ route(auth()->user()->isAdmin() ? 'admin.reports.index' : 'agent.reports.index') }}"
                   class="neo-btn flex-1 bg-gray-200 text-black py-4 text-center">Cancel</a>
            </div>
        </form>
    </div>

</div>
@endsection
