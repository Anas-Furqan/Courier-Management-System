@extends('layouts.app')

@section('page-title', 'Agent Details')

@section('content')
<div class="space-y-8 max-w-4xl">

    {{-- Hero --}}
    <div class="page-hero bg-purple-300 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <div>
            <p class="text-xs font-black uppercase tracking-widest mb-2 text-black/60">Agent Profile</p>
            <h1 class="text-4xl font-black mb-1">{{ $agent->user->name }}</h1>
            <p class="font-bold font-mono">{{ $agent->agent_code }}</p>
        </div>
        <span class="s-{{ $agent->status }} flex-shrink-0 self-start">{{ ucfirst($agent->status) }}</span>
    </div>

    {{-- Details Grid --}}
    <div class="grid gap-6 sm:grid-cols-2">
        <div class="info-card">
            <p class="info-label">Email Address</p>
            <p class="info-value break-words">{{ $agent->user->email }}</p>
        </div>

        <div class="info-card">
            <p class="info-label">Phone Number</p>
            <p class="info-value">{{ $agent->user->phone }}</p>
        </div>

        <div class="info-card">
            <p class="info-label">Branch City</p>
            <p class="info-value">{{ $agent->branch_city }}</p>
        </div>

        <div class="info-card">
            <p class="info-label">Status</p>
            <span class="s-{{ $agent->status }} mt-1 inline-block">{{ ucfirst($agent->status) }}</span>
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex gap-4">
        <a href="{{ route('admin.agents.edit', $agent->id) }}" class="neo-btn flex-1 bg-yellow-300 text-black text-center py-3">Edit Agent</a>
        <a href="{{ route('admin.agents.index') }}" class="neo-btn flex-1 bg-gray-200 text-black text-center py-3">← Back to Agents</a>
    </div>

</div>
@endsection
