@extends('layouts.app')

@section('content')
<div class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr]" data-reveal>
    <div class="glass-panel p-6">
        <p class="section-kicker">Account</p>
        <h3 class="mt-4 text-2xl font-bold text-white">{{ $user->name }}</h3>
        <dl class="mt-6 space-y-4 text-sm text-slate-300">
            <div class="flex justify-between gap-4 border-b border-white/10 pb-3">
                <dt>Email</dt>
                <dd class="text-slate-100">{{ $user->email }}</dd>
            </div>
            <div class="flex justify-between gap-4 border-b border-white/10 pb-3">
                <dt>Phone</dt>
                <dd class="text-slate-100">{{ $user->phone ?? 'Not set' }}</dd>
            </div>
            <div class="flex justify-between gap-4">
                <dt>City</dt>
                <dd class="text-slate-100">{{ $user->city ?? 'Not set' }}</dd>
            </div>
        </dl>
    </div>

    <div class="glass-panel p-6">
        <h3 class="text-2xl font-bold text-white">Update details</h3>
        <form class="mt-6 grid gap-4 sm:grid-cols-2" action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="sm:col-span-2">
                <label class="input-label" for="name">Name</label>
                <input class="input-field" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required>
            </div>
            <div>
                <label class="input-label" for="phone">Phone</label>
                <input class="input-field" id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" required>
            </div>
            <div>
                <label class="input-label" for="city">City</label>
                <input class="input-field" id="city" name="city" type="text" value="{{ old('city', $user->city) }}" required>
            </div>
            <div class="sm:col-span-2">
                <button class="btn-primary" type="submit">Save changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
