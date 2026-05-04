@extends('layouts.guest')

@section('content')
<div class="neo-card bg-white">
    <h2 class="text-3xl font-black mb-2">Welcome Back</h2>
    <p class="text-lg font-bold mb-8 border-b-4 border-black pb-4">Sign in to your account</p>

    <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-black uppercase mb-3">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" class="neo-input w-full" placeholder="you@example.com" required>
            @error('email')<p class="mt-2 font-bold text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-black uppercase mb-3">Password</label>
            <input type="password" name="password" class="neo-input w-full" placeholder="••••••••" required>
            @error('password')<p class="mt-2 font-bold text-red-600">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="neo-btn w-full bg-blue-500 text-white py-4 text-lg">
            Sign In
        </button>
    </form>

    <div class="mt-8 border-t-4 border-black pt-6 text-center">
        <p class="font-bold">Don't have an account? <a href="{{ route('register') }}" class="underline font-black">Sign up</a></p>
    </div>
</div>

<div class="mt-8 p-6 bg-yellow-300 border-4 border-black" style="box-shadow: 6px 6px 0 #000;">
    <p class="font-black text-sm">DEMO ACCOUNTS</p>
    <p class="font-bold text-sm mt-2">Admin: admin@example.com / password</p>
    <p class="font-bold text-sm">Agent: agent@example.com / password</p>
</div>
@endsection