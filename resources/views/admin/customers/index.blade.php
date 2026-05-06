@extends('layouts.app')

@section('page-title', 'Customer Management')

@section('content')
<div class="space-y-8">

    {{-- Hero --}}
    <div class="page-hero bg-pink-400">
        <h1 class="text-4xl font-black mb-1">Customers</h1>
        <p class="font-bold text-black/70">Manage and monitor all registered customers.</p>
    </div>

    {{-- Table --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-pink-500 text-white border-b-4 border-black">
            <h2 class="text-2xl font-black">All Customers ({{ count($customers) }})</h2>
            <form action="{{ route('admin.customers.search') }}" method="GET" class="flex gap-2 flex-1 max-w-sm">
                <input class="neo-input py-2 flex-1" name="q" placeholder="Search name, email..." style="box-shadow:none;">
                <button class="neo-btn-sm bg-black text-white flex-shrink-0">Search</button>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="neo-table">
                <thead>
                    <tr>
                        <th>Company / Name</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td class="font-black">{{ $customer->company_name ?? $customer->user->name ?? 'Customer' }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->city }}</td>
                            <td>{{ $customer->phone ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.customers.show', $customer->id) }}" class="neo-btn-sm bg-cyan-400 text-black">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
