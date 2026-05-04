@extends('layouts.app')

@section('page-title', 'Create agent')

@section('content')
    <div data-reveal class="panel p-6">
        <p class="badge bg-cyan-400/15 text-cyan-200 ring-1 ring-cyan-300/20">Agent onboarding</p>
        <form class="mt-6 grid gap-4 sm:grid-cols-2" action="{{ route('admin.agents.store') }}" method="POST">
            @csrf
            <div><label class="mb-2 block text-sm text-slate-300">Name</label><input class="input-shell" name="name" required></div>
            <div><label class="mb-2 block text-sm text-slate-300">Email</label><input class="input-shell" name="email" type="email" required></div>
            <div><label class="mb-2 block text-sm text-slate-300">Phone</label><input class="input-shell" name="phone" required></div>
            <div><label class="mb-2 block text-sm text-slate-300">Password</label><input class="input-shell" name="password" type="password" required></div>
            <div><label class="mb-2 block text-sm text-slate-300">Branch city</label><input class="input-shell" name="branch_city" required></div>
            <div><label class="mb-2 block text-sm text-slate-300">Agent code</label><input class="input-shell" name="agent_code" required></div>
            <div class="sm:col-span-2"><button class="button-primary" type="submit">Save agent</button></div>
        </form>
    </div>
@endsection
