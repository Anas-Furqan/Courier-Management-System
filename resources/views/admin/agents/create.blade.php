@extends('layouts.app')

@section('page-title', 'Create Agent')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8 flex justify-between items-center" style="background: linear-gradient(to right, #06B6D4, #0EA5E9); box-shadow: 8px 8px 0 #000;">
        <div>
            <h1 class="text-4xl font-black mb-2">Add New Agent</h1>
            <p class="text-lg font-bold">Register a new delivery agent for your branch.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="border-4 border-black bg-white p-8" style="box-shadow: 8px 8px 0 #000;">
        <form class="grid gap-6 sm:grid-cols-2" action="{{ route('admin.agents.store') }}" method="POST">
            @csrf
            
            <div>
                <label class="block font-bold mb-3">Full Name *</label>
                <input class="neo-input w-full" name="name" required>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Email Address *</label>
                <input class="neo-input w-full" name="email" type="email" required>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Phone Number *</label>
                <input class="neo-input w-full" name="phone" required>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Password *</label>
                <input class="neo-input w-full" name="password" type="password" required>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Branch City *</label>
                <input class="neo-input w-full" name="branch_city" required>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Agent Code *</label>
                <input class="neo-input w-full" name="agent_code" placeholder="e.g., AG-001" required>
            </div>
            
            <div class="sm:col-span-2 flex gap-4">
                <button class="neo-btn px-6 py-3 flex-1" type="submit" style="background-color: #4ADE80; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000;">Create Agent</button>
                <a href="{{ route('admin.agents.index') }}" class="neo-btn px-6 py-3 text-center" style="background-color: #E5E7EB; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: black;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
