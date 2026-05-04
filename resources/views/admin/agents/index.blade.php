@extends('layouts.app')

@section('page-title', 'Agents Management')

@section('content')
<div class="space-y-8" data-reveal>
    <div class="hero-panel">
        <div>
            <p class="section-kicker">Agent Management</p>
            <h1 class="mt-3 text-4xl font-black text-white">Branch Agents</h1>
            <p class="mt-3 max-w-2xl text-slate-300">Manage all branch agents and their operational assignments.</p>
        </div>
        <a href="{{ route('admin.agents.create') }}" class="btn-primary">+ Add Agent</a>
    </div>

    <div class="glass-panel overflow-hidden">
        <div class="border-b border-white/10 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">All Agents ({{ count($agents) }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.25em] text-slate-400">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Name</th>
                        <th class="px-6 py-4 font-semibold">Branch City</th>
                        <th class="px-6 py-4 font-semibold">Agent Code</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($agents as $agent)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 text-white font-semibold">{{ $agent->user->name ?? 'Agent' }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $agent->branch_city }}</td>
                            <td class="px-6 py-4 font-mono text-cyan-400">{{ $agent->agent_code }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] {{ $agent->status === 'active' ? 'bg-emerald-400/15 text-emerald-200' : 'bg-slate-400/15 text-slate-300' }}">
                                    {{ ucfirst($agent->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2 text-sm">
                                    <a href="{{ route('admin.agents.show', $agent->id) }}" class="text-cyan-400 hover:text-cyan-300 transition font-semibold">View</a>
                                    <span class="text-white/20">•</span>
                                    <a href="{{ route('admin.agents.edit', $agent->id) }}" class="text-blue-400 hover:text-blue-300 transition font-semibold">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-10 text-center text-slate-400">No agents found. Create your first agent to get started.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
