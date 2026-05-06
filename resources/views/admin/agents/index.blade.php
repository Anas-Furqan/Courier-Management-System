@extends('layouts.app')

@section('page-title', 'Agents Management')

@section('content')
<div class="space-y-8">

    {{-- Hero --}}
    <div class="page-hero bg-green-400 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-black mb-1">Branch Agents</h1>
            <p class="font-bold text-black/70">Manage all branch agents and their operational assignments.</p>
        </div>
        <a href="{{ route('admin.agents.create') }}" class="neo-btn bg-black text-white flex-shrink-0">+ Add Agent</a>
    </div>

    {{-- Agents Table --}}
    <div class="neo-table-wrap">
        <div class="neo-table-head bg-blue-500 text-white border-b-4 border-black">
            <h2 class="text-2xl font-black">All Agents ({{ count($agents) }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="neo-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Branch City</th>
                        <th>Agent Code</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                        <tr>
                            <td class="font-black">{{ $agent->user->name ?? 'Agent' }}</td>
                            <td>{{ $agent->branch_city }}</td>
                            <td class="font-mono">{{ $agent->agent_code }}</td>
                            <td>
                                <span class="s-{{ $agent->status }}">{{ ucfirst($agent->status) }}</span>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.agents.show', $agent->id) }}" class="neo-btn-sm bg-cyan-400 text-black">View</a>
                                    <a href="{{ route('admin.agents.edit', $agent->id) }}" class="neo-btn-sm bg-yellow-300 text-black">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500">No agents found. Create your first agent.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
