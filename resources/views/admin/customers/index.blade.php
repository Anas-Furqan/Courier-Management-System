@extends('layouts.app')

@section('page-title', 'Customer Management')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #EC4899, #F472B6); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">Customers</h1>
        <p class="text-lg font-bold">Manage and monitor all registered customers and their shipment activities.</p>
    </div>

    <!-- Customers Table -->
    <div class="border-4 border-black bg-white" style="box-shadow: 8px 8px 0 #000;">
        <div class="text-white border-b-4 border-black p-6" style="background-color: #EC4899;">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-2xl font-black">All Customers ({{ count($customers) }})</h2>
                <form action="{{ route('admin.customers.search') }}" method="GET" class="flex gap-2">
                    <input class="neo-input flex-1" name="q" placeholder="Search name, email...">
                    <button class="neo-btn bg-black text-white px-4 py-2" style="border-width: 4px; border-color: black; box-shadow: 4px 4px 0 0 #000;">Search</button>
                </form>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-4 border-black bg-gray-200">
                        <th class="px-6 py-4 text-left font-black">Company Name</th>
                        <th class="px-6 py-4 text-left font-black">Email</th>
                        <th class="px-6 py-4 text-left font-black">City</th>
                        <th class="px-6 py-4 text-left font-black">Phone</th>
                        <th class="px-6 py-4 text-left font-black">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr class="border-b-2 border-black hover:bg-gray-100">
                            <td class="px-6 py-4 font-bold">{{ $customer->company_name ?? $customer->user->name ?? 'Customer' }}</td>
                            <td class="px-6 py-4 font-bold">{{ $customer->email }}</td>
                            <td class="px-6 py-4 font-bold">{{ $customer->city }}</td>
                            <td class="px-6 py-4 font-bold">{{ $customer->phone ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.customers.show', $customer->id) }}" class="px-3 py-1 bg-cyan-400 border-2 border-black font-bold text-sm">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center font-bold">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
