@extends('layouts.guest')

@section('content')
<div class="grid w-full gap-8 lg:grid-cols-[0.95fr_1.05fr]">
    <section class="glass-panel p-8 shadow-2xl shadow-indigo-950/20" data-reveal>
        <div class="mb-8">
            <p class="text-sm uppercase tracking-[0.35em] text-indigo-300/70">Customer onboarding</p>
            <h2 class="mt-2 text-3xl font-bold text-white">Create your account</h2>
        </div>

        <form method="POST" action="{{ route('register.submit') }}" class="grid gap-4 sm:grid-cols-2">
            @csrf
            <div class="sm:col-span-1">
                <label class="input-label">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="input-field" required>
            </div>
            <div class="sm:col-span-1">
                <label class="input-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="input-field" required>
            </div>
            <div class="sm:col-span-1">
                <label class="input-label">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="input-field" required>
            </div>
            <div class="sm:col-span-1">
                <label class="input-label">City</label>
                <input type="text" name="city" value="{{ old('city') }}" class="input-field" required>
            </div>
            <div class="sm:col-span-1">
                <label class="input-label">Password</label>
                <input type="password" name="password" class="input-field" required>
            </div>
            <div class="sm:col-span-1">
                <label class="input-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="input-field" required>
            </div>
            <div class="sm:col-span-2">
                <label class="input-label">Company Name</label>
                <input type="text" name="company_name" value="{{ old('company_name') }}" class="input-field">
            </div>
            <div class="sm:col-span-2">
                <label class="input-label">Address</label>
                <textarea name="address" rows="4" class="input-field" required>{{ old('address') }}</textarea>
            </div>
            <div class="sm:col-span-2">
                <button type="submit" class="btn-primary w-full">Create Account</button>
            </div>
        </form>
    </section>

    <section class="flex flex-col justify-center" data-reveal>
        <h1 class="max-w-2xl text-5xl font-black leading-tight text-white sm:text-6xl">Book, track, and manage shipments from one place.</h1>
        <p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">The customer portal is designed for a premium experience with fast registration, tracking shortcuts, and beautifully presented shipment history.</p>
        <div class="mt-8 grid gap-4 sm:grid-cols-2">
            <div class="feature-card">Responsive interface with Tailwind CSS.</div>
            <div class="feature-card">Motion effects for a modern feel.</div>
            <div class="feature-card">Tracking history in one view.</div>
            <div class="feature-card">Fast profile management.</div>
        </div>
    </section>
</div>
@endsection