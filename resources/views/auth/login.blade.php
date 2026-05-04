@extends('layouts.guest')

@section('content')
<div class="grid w-full gap-8 lg:grid-cols-[1.1fr_0.9fr]">
    <section class="flex flex-col justify-center" data-reveal>
        <p class="mb-4 inline-flex w-fit rounded-full border border-cyan-400/30 bg-cyan-400/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.35em] text-cyan-200">Courier Intelligence</p>
        <h1 class="max-w-2xl text-5xl font-black leading-tight text-white sm:text-6xl">Control every shipment with a premium command center.</h1>
        <p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">Manage couriers, agents, customers, tracking and reports from a sleek Laravel dashboard built with Tailwind CSS and motion-driven interactions.</p>
        <div class="mt-8 flex flex-wrap gap-3 text-sm text-slate-300">
            <span class="badge">Live Tracking</span>
            <span class="badge">Branch Control</span>
            <span class="badge">Report Export</span>
            <span class="badge">SMS Logs</span>
        </div>
    </section>

    <section class="glass-panel p-8 shadow-2xl shadow-cyan-950/30" data-reveal>
        <div class="mb-8">
            <p class="text-sm uppercase tracking-[0.35em] text-cyan-300/70">Welcome back</p>
            <h2 class="mt-2 text-3xl font-bold text-white">Sign in to continue</h2>
        </div>

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
            @csrf
            <div>
                <label class="input-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="input-field" placeholder="you@example.com" required>
                @error('email')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="input-label">Password</label>
                <input type="password" name="password" class="input-field" placeholder="••••••••" required>
                @error('password')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="btn-primary w-full">Login</button>
        </form>

        <p class="mt-6 text-sm text-slate-300">New here? <a href="{{ route('register') }}" class="font-semibold text-cyan-300 hover:text-cyan-200">Create an account</a></p>
    </section>
</div>
@endsection