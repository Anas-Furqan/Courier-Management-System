@extends('layouts.app')

@section('page-title', 'Agent Details')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="border-4 border-black p-8" style="background: linear-gradient(to right, #A78BFA, #C084FC); box-shadow: 8px 8px 0 #000;">
        <h1 class="text-4xl font-black mb-2">{{ $agent->user->name }}</h1>
        <p class="text-lg font-bold">{{ $agent->agent_code }}</p>
    </div>

    <!-- Details Grid -->
    <div class="grid gap-6 sm:grid-cols-2">
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2">EMAIL ADDRESS</p>
            <p class="text-2xl font-black">{{ $agent->user->email }}</p>
        </div>
        
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2">PHONE NUMBER</p>
            <p class="text-2xl font-black">{{ $agent->user->phone }}</p>
        </div>
        
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2">BRANCH CITY</p>
            <p class="text-2xl font-black">{{ $agent->branch_city }}</p>
        </div>
        
        <div class="border-4 border-black bg-white p-8" style="box-shadow: 6px 6px 0 #000;">
            <p class="text-sm font-bold text-gray-600 mb-2">STATUS</p>
            <p class="text-2xl font-black" style="color: {{ $agent->status === 'active' ? '#4ADE80' : '#EF4444' }}">{{ ucfirst($agent->status) }}</p>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4">
        <a href="{{ route('admin.agents.edit', $agent->id) }}" class="neo-btn px-6 py-3 flex-1 text-center" style="background-color: #FCD34D; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: black;">Edit Agent</a>
        <a href="{{ route('admin.agents.index') }}" class="neo-btn px-6 py-3 flex-1 text-center" style="background-color: #E5E7EB; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: black;">Back to Agents</a>
    </div>
</div>
@endsection
