@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #A78BFA, #C084FC); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">My Profile</h1>
        <p class="text-lg font-bold">Manage your account information.</p>
    </div>

    <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
        <!-- Profile Info Card -->
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-4 uppercase">Account Information</p>
            <h3 class="text-3xl font-black mb-6">{{ $user->name }}</h3>
            <dl class="space-y-4">
                <div class="border-b-2 border-black pb-3">
                    <dt class="text-sm font-bold text-gray-600 uppercase">Email</dt>
                    <dd class="text-lg font-bold mt-2">{{ $user->email }}</dd>
                </div>
                <div class="border-b-2 border-black pb-3">
                    <dt class="text-sm font-bold text-gray-600 uppercase">Phone</dt>
                    <dd class="text-lg font-bold mt-2">{{ $user->phone ?? 'Not set' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-bold text-gray-600 uppercase">City</dt>
                    <dd class="text-lg font-bold mt-2">{{ $user->city ?? 'Not set' }}</dd>
                </div>
            </dl>
        </div>

        <!-- Update Form Card -->
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <h3 class="text-2xl font-black mb-6">Update Details</h3>
            <form class="grid gap-6 sm:grid-cols-2" action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="sm:col-span-2">
                    <label class="block font-bold mb-3">Name *</label>
                    <input class="neo-input w-full" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required>
                </div>
                <div>
                    <label class="block font-bold mb-3">Phone *</label>
                    <input class="neo-input w-full" id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" required>
                </div>
                <div>
                    <label class="block font-bold mb-3">City *</label>
                    <input class="neo-input w-full" id="city" name="city" type="text" value="{{ old('city', $user->city) }}" required>
                </div>
                <div class="sm:col-span-2 flex gap-4">
                    <button class="neo-btn px-6 py-3 flex-1" type="submit" style="background-color: #A78BFA; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: white;">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
