@extends('layouts.app')

@section('page-title', 'Edit Agent')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8 flex justify-between items-center" style="background: linear-gradient(to right, #FCD34D, #FBBF24); box-shadow: 8px 8px 0 #000;">
        <div>
            <h1 class="text-4xl font-black mb-2">Edit Agent</h1>
            <p class="text-lg font-bold">Update agent information and settings.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="border-4 border-black bg-white p-8" style="box-shadow: 8px 8px 0 #000;">
        <form class="grid gap-6 sm:grid-cols-2" action="{{ route('admin.agents.update', $agent->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block font-bold mb-3">Full Name *</label>
                <input class="neo-input w-full" name="name" value="{{ $agent->user->name }}" required>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Email Address *</label>
                <input class="neo-input w-full" name="email" type="email" value="{{ $agent->user->email }}" required>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Phone Number *</label>
                <input class="neo-input w-full" name="phone" value="{{ $agent->user->phone }}" required>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Branch City *</label>
                <input class="neo-input w-full" name="branch_city" value="{{ $agent->branch_city }}" required>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Agent Code *</label>
                <input class="neo-input w-full" name="agent_code" value="{{ $agent->agent_code }}" required>
            </div>
            
            <div>
                <label class="block font-bold mb-3">Status *</label>
                <select class="neo-input w-full" name="status" required>
                    <option value="active" {{ $agent->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $agent->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            
            <div class="sm:col-span-2 flex gap-4">
                <button class="neo-btn px-6 py-3 flex-1" type="submit" style="background-color: #FCD34D; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: black;">Update Agent</button>
                <a href="{{ route('admin.agents.show', $agent->id) }}" class="neo-btn px-6 py-3 text-center" style="background-color: #E5E7EB; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: black;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
