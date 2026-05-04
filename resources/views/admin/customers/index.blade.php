@extends('layouts.app')

@section('page-title', 'Customer Management')

@section('content')
<div class="space-y-8" data-reveal>
    <div class="hero-panel">
        <div>
            <p class="section-kicker">Customer Management</p>
            <h1 class="mt-3 text-4xl font-black text-white">Customers</h1>
            <p class="mt-3 max-w-2xl text-slate-300">Manage and monitor all registered customers and their shipment activities.</p>
        </div>
    </div>

    <div class="glass-panel overflow-hidden">
        <div class="border-b border-white/10 px-6 py-4">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-xl font-semibold text-white">All Customers ({{ count($customers) }})</h2>
                <form action="{{ route('admin.customers.search') }}" method="GET" class="flex gap-2 flex-1 sm:flex-none sm:w-80">
                    <input class="input-field flex-1" name="q" placeholder="Search by name, email..." aria-label="Search">
                    <button class="btn-secondary" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.25em] text-slate-400">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Company Name</th>
                        <th class="px-6 py-4 font-semibold">Contact Email</th>
                        <th class="px-6 py-4 font-semibold">City</th>
                        <th class="px-6 py-4 font-semibold">Phone</th>
                        <th class="px-6 py-4 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 text-white font-semibold">{{ $customer->company_name ?? $customer->user->name ?? 'Customer' }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $customer->email }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $customer->city }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $customer->phone ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.customers.show', $customer->id) }}" class="text-cyan-400 hover:text-cyan-300 transition text-sm font-semibold">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-10 text-center text-slate-400">No customers found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
