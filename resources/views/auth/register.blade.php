@extends('layouts.guest')

@section('content')
<div class="neo-card bg-white max-w-2xl w-full">
    <h2 class="text-3xl font-black mb-2">Create Account</h2>
    <p class="text-lg font-bold mb-8 border-b-4 border-black pb-4">Join the courier revolution</p>

    <form method="POST" action="{{ route('register.submit') }}" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-black uppercase mb-3">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="neo-input w-full" placeholder="John Doe" required>
                @error('name')<p class="mt-2 font-bold text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-black uppercase mb-3">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="neo-input w-full" placeholder="you@example.com" required>
                @error('email')<p class="mt-2 font-bold text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-black uppercase mb-3">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="neo-input w-full" placeholder="+91 98765 43210" required>
            </div>
            <div>
                <label class="block text-sm font-black uppercase mb-3">City</label>
                <input type="text" name="city" value="{{ old('city') }}" class="neo-input w-full" placeholder="Mumbai" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-black uppercase mb-3">Company Name (Optional)</label>
            <input type="text" name="company_name" value="{{ old('company_name') }}" class="neo-input w-full" placeholder="Your Company">
        </div>

        <div>
            <label class="block text-sm font-black uppercase mb-3">Address</label>
            <textarea name="address" rows="3" class="neo-input w-full" placeholder="123 Main St..." required>{{ old('address') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-black uppercase mb-3">Password</label>
                <input type="password" name="password" class="neo-input w-full" placeholder="Min 8 characters" required>
                @error('password')<p class="mt-2 font-bold text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-black uppercase mb-3">Confirm Password</label>
                <input type="password" name="password_confirmation" class="neo-input w-full" placeholder="Repeat password" required>
            </div>
        </div>

        <button type="submit" class="neo-btn w-full bg-green-400 text-black py-4 text-lg">
            Create Account
        </button>
    </form>

    <div class="mt-8 border-t-4 border-black pt-6 text-center">
        <p class="font-bold">Already have an account? <a href="{{ route('login') }}" class="underline font-black">Sign in</a></p>
    </div>
</div>
</div>
@endsection