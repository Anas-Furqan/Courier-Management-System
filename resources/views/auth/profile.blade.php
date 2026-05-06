@extends('layouts.app')

@section('page-title', 'My Profile')

@section('content')
<div class="space-y-8 max-w-5xl">

    {{-- Hero --}}
    <div class="page-hero bg-purple-300">
        <h1 class="text-4xl font-black mb-1">My Profile</h1>
        <p class="font-bold text-black/70">Manage your account information and preferences.</p>
    </div>

    <div class="grid gap-8 lg:grid-cols-2">

        {{-- Profile Info --}}
        <div class="neo-card p-8">
            <p class="info-label">Account Information</p>
            <h3 class="text-3xl font-black mb-6">{{ $user->name }}</h3>
            <dl class="space-y-5">
                <div class="border-b-2 border-black pb-4">
                    <dt class="info-label">Email</dt>
                    <dd class="info-value">{{ $user->email }}</dd>
                </div>
                <div class="border-b-2 border-black pb-4">
                    <dt class="info-label">Phone</dt>
                    <dd class="info-value">{{ $user->phone ?? 'Not set' }}</dd>
                </div>
                <div>
                    <dt class="info-label">City</dt>
                    <dd class="info-value">{{ $user->city ?? 'Not set' }}</dd>
                </div>
            </dl>
        </div>

        {{-- Update Form --}}
        <div class="neo-card p-8">
            <h3 class="section-title">Update Details</h3>
            <form class="space-y-5" action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div>
                    <label class="form-label">Name *</label>
                    <input class="neo-input" name="name" type="text" value="{{ old('name', $user->name) }}" required>
                </div>
                <div>
                    <label class="form-label">Phone *</label>
                    <input class="neo-input" name="phone" type="text" value="{{ old('phone', $user->phone) }}" required>
                </div>
                <div>
                    <label class="form-label">City *</label>
                    <input class="neo-input" name="city" type="text" value="{{ old('city', $user->city) }}" required>
                </div>
                <button class="neo-btn w-full bg-purple-400 text-black py-3" type="submit">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
