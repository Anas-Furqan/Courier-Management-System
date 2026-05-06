@extends('layouts.guest')

@section('content')
<div class="neo-card-xl p-8 bg-white">
    <h2 class="text-3xl font-black mb-1">Welcome Back</h2>
    <p class="font-bold text-gray-600 mb-8 pb-6 border-b-4 border-black">Sign in to your account</p>

    <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
        @csrf

        <div>
            <label class="form-label">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" class="neo-input" placeholder="you@example.com" required>
            @error('email')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="form-label">Password</label>
            <input type="password" name="password" class="neo-input" placeholder="••••••••" required>
            @error('password')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="neo-btn w-full bg-blue-500 text-white py-4 text-base mt-2">
            Sign In →
        </button>
    </form>

    <div class="mt-8 pt-6 border-t-4 border-black text-center">
        <p class="font-bold">Don't have an account?
            <a href="{{ route('register') }}" class="font-black underline underline-offset-4 decoration-2">Sign up free</a>
        </p>
    </div>
</div>

<div class="mt-6 border-4 border-black p-5 bg-white" style="box-shadow:4px 4px 0 0 #000;">
    <p class="font-black text-xs uppercase tracking-widest mb-3">Demo Accounts</p>
    <div class="space-y-2 text-sm font-bold text-gray-700">
        <p>🔑 <span class="font-black">Admin:</span> admin@example.com / password</p>
        <p>🔑 <span class="font-black">Agent:</span> agent@example.com / password</p>
    </div>
</div>
@endsection
