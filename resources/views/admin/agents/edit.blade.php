@extends('layouts.app')

@section('page-title', 'Edit Agent')

@section('content')
<div class="space-y-8 max-w-3xl">

    {{-- Hero --}}
    <div class="page-hero bg-yellow-300">
        <h1 class="text-4xl font-black mb-1">Edit Agent</h1>
        <p class="font-bold text-black/70">Update agent information and branch assignment.</p>
    </div>

    {{-- Form --}}
    <div class="neo-card-xl p-8 bg-white">
        <form class="grid gap-6 sm:grid-cols-2" action="{{ route('admin.agents.update', $agent->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Full Name *</label>
                <input class="neo-input" name="name" value="{{ old('name', $agent->user->name) }}" required>
            </div>

            <div>
                <label class="form-label">Email Address *</label>
                <input class="neo-input" name="email" type="email" value="{{ old('email', $agent->user->email) }}" required>
            </div>

            <div>
                <label class="form-label">Phone Number *</label>
                <input class="neo-input" name="phone" value="{{ old('phone', $agent->user->phone) }}" required>
            </div>

            <div>
                <label class="form-label">Branch City *</label>
                <select class="neo-input" name="branch_city" required>
                    <option value="">Select a city...</option>
                    @foreach(['Karachi','Lahore','Islamabad','Rawalpindi','Faisalabad','Multan','Peshawar','Quetta'] as $city)
                        <option value="{{ $city }}" {{ $agent->branch_city === $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label">Agent Code *</label>
                <input class="neo-input" name="agent_code" value="{{ old('agent_code', $agent->agent_code) }}" required>
            </div>

            <div>
                <label class="form-label">Status *</label>
                <select class="neo-input" name="status" required>
                    <option value="active"   {{ $agent->status === 'active'   ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $agent->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="sm:col-span-2 flex gap-4 pt-2 border-t-4 border-black mt-2">
                <button class="neo-btn flex-1 bg-yellow-300 text-black py-4" type="submit">Update Agent</button>
                <a href="{{ route('admin.agents.show', $agent->id) }}" class="neo-btn flex-1 bg-gray-200 text-black py-4 text-center">Cancel</a>
            </div>
        </form>
    </div>

</div>
@endsection
