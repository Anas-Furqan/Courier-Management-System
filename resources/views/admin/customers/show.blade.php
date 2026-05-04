@extends('layouts.app')

@section('page-title', 'Customer profile')

@section('content')
    <div data-reveal class="panel p-6">
        <h3 class="font-display text-2xl font-semibold text-white">{{ $customer->company_name ?? $customer->user->name }}</h3>
        <p class="mt-2 text-sm text-slate-400">{{ $customer->address }}</p>
    </div>
@endsection
