@extends('layouts.app')

@section('page-title', 'Agents Management')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8 flex justify-between items-center" style="background: linear-gradient(to right, #4ADE80, #22C55E); box-shadow: 8px 8px 0 #000;">
        <div>
            <h1 class="text-4xl font-black mb-2">Branch Agents</h1>
            <p class="text-lg font-bold">Manage all branch agents and their operational assignments.</p>
        </div>
        <a href="{{ route('admin.agents.create') }}" class="neo-btn bg-black text-white px-6 py-3" style="border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000;">+ Add Agent</a>
    </div>

    <!-- Agents Table -->
    <div class="border-4 border-black bg-white" style="box-shadow: 8px 8px 0 #000;">
        <div class="text-white border-b-4 border-black p-6" style="background-color: #3B82F6;">
            <h2 class="text-2xl font-black">All Agents ({{ count($agents) }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-4 border-black bg-gray-200">
                        <th class="px-6 py-4 text-left font-black">Name</th>
                        <th class="px-6 py-4 text-left font-black">Branch City</th>
                        <th class="px-6 py-4 text-left font-black">Agent Code</th>
                        <th class="px-6 py-4 text-left font-black">Status</th>
                        <th class="px-6 py-4 text-left font-black">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                        <tr class="border-b-2 border-black hover:bg-gray-100">
                            <td class="px-6 py-4 font-bold">{{ $agent->user->name ?? 'Agent' }}</td>
                            <td class="px-6 py-4 font-bold">{{ $agent->branch_city }}</td>
                            <td class="px-6 py-4 font-mono font-bold">{{ $agent->agent_code }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 font-bold text-sm uppercase border-2 border-black" style="background-color: {{ $agent->status === 'active' ? '#4ADE80' : '#E5E7EB' }};">{{ ucfirst($agent->status) }}</span>
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('admin.agents.show', $agent->id) }}" class="px-3 py-1 bg-cyan-400 border-2 border-black font-bold text-sm">View</a>
                                <a href="{{ route('admin.agents.edit', $agent->id) }}" class="px-3 py-1 bg-yellow-300 border-2 border-black font-bold text-sm">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center font-bold">No agents found. Create your first agent.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
