@extends('layouts.app')

@section('page-title', 'Create Agent')

@section('content')
<div class="space-y-8 max-w-3xl">

    {{-- Hero --}}
    <div class="page-hero bg-cyan-400">
        <h1 class="text-4xl font-black mb-1">Add New Agent</h1>
        <p class="font-bold text-black/70">Register a new delivery agent for your branch.</p>
    </div>

    {{-- Form --}}
    <div class="neo-card-xl p-8 bg-white">
        <form class="grid gap-6 sm:grid-cols-2" action="{{ route('admin.agents.store') }}" method="POST">
            @csrf

            <div>
                <label class="form-label">Full Name *</label>
                <input class="neo-input" name="name" value="{{ old('name') }}" placeholder="Jane Doe" required>
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Email Address *</label>
                <input class="neo-input" name="email" type="email" value="{{ old('email') }}" placeholder="agent@example.com" required>
                @error('email')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Phone Number *</label>
                <input class="neo-input" name="phone" value="{{ old('phone') }}" placeholder="+92 300 0000000" required>
            </div>

            <div>
                <label class="form-label">Password *</label>
                <input class="neo-input" name="password" type="password" placeholder="Min 8 characters" required>
                @error('password')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Branch City *</label>
                <select class="neo-input" name="branch_city" required>
                    <option value="">Select a city...</option>
                    @foreach(['Karachi','Lahore','Islamabad','Rawalpindi','Faisalabad','Multan','Peshawar','Quetta'] as $city)
                        <option value="{{ $city }}" {{ old('branch_city') === $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label">Agent Code *</label>
                <input class="neo-input" name="agent_code" value="{{ old('agent_code') }}" placeholder="e.g., AG-001" required>
            </div>

            <div class="sm:col-span-2 flex gap-4 pt-2 border-t-4 border-black mt-2">
                <button class="neo-btn flex-1 bg-green-400 text-black py-4" type="submit">Create Agent</button>
                <a href="{{ route('admin.agents.index') }}" class="neo-btn flex-1 bg-gray-200 text-black py-4 text-center">Cancel</a>
            </div>
        </form>
    </div>

</div>
@endsection
