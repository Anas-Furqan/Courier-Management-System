@extends('layouts.guest')

@section('content')
<div class="mx-auto max-w-2xl space-y-8" data-reveal>
    <div class="hero-panel">
        <div>
            <p class="section-kicker">Real-Time Tracking</p>
            <h1 class="mt-3 text-4xl font-black text-white">Track Your Shipment</h1>
            <p class="mt-3 text-slate-300">Enter your tracking number to get live updates on your package location and delivery status.</p>
        </div>
    </div>

    <div class="glass-panel p-8 sm:p-12">
        <form class="space-y-6" action="#" method="GET" onsubmit="event.preventDefault(); const value = this.querySelector('input').value.trim(); if (value) { window.location.href = '{{ url('/track') }}/' + encodeURIComponent(value); }">
            <div>
                <label class="input-label">Tracking Number</label>
                <input class="input-field text-lg h-12" type="text" placeholder="e.g., CMS202605040001" aria-label="Tracking number" required>
                <p class="text-sm text-slate-400 mt-2">You'll find this number on your shipment receipt or SMS notification.</p>
            </div>
            <button class="btn-primary w-full text-lg h-12" type="submit">Track Shipment</button>
        </form>

        <div class="mt-8 pt-8 border-t border-white/10">
            <p class="text-sm text-slate-400 mb-4 font-semibold uppercase tracking-[0.25em]">Need Help?</p>
            <ul class="space-y-3 text-slate-300 text-sm">
                <li class="flex gap-3">
                    <span class="text-cyan-400">•</span>
                    <span>Tracking numbers start with <span class="text-white font-mono">CMS</span> followed by a 12-digit code</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-cyan-400">•</span>
                    <span>You'll receive tracking details via SMS and email</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-cyan-400">•</span>
                    <span>Updates are available 24/7 from booking to delivery</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
