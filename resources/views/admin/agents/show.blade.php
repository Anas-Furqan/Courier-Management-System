@extends('layouts.app')

@section('page-title', 'Agent profile')

@section('content')
    <div data-reveal class="panel p-6">
        <h3 class="font-display text-2xl font-semibold text-white">{{ $agent->user->name }}</h3>
        <dl class="mt-6 grid gap-4 sm:grid-cols-2 text-sm text-slate-300">
            <div class="rounded-3xl border border-white/10 bg-white/5 p-5"><dt class="text-slate-400">Email</dt><dd class="mt-1 text-white">{{ $agent->user->email }}</dd></div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-5"><dt class="text-slate-400">Phone</dt><dd class="mt-1 text-white">{{ $agent->user->phone }}</dd></div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-5"><dt class="text-slate-400">Branch city</dt><dd class="mt-1 text-white">{{ $agent->branch_city }}</dd></div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-5"><dt class="text-slate-400">Code</dt><dd class="mt-1 text-white">{{ $agent->agent_code }}</dd></div>
        </dl>
    </div>
@endsection
