@extends('layouts.guest')

@section('content')
<div class="neo-card-xl p-8 bg-white w-full max-w-2xl mx-auto">
    <h2 class="text-3xl font-black mb-1">Create Account</h2>
    <p class="font-bold text-gray-600 mb-8 pb-6 border-b-4 border-black">Join the courier revolution</p>

    <form method="POST" action="{{ route('register.submit') }}" class="space-y-5">
        @csrf

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" class="neo-input" placeholder="John Doe" required>
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="form-label">Email Address *</label>
                <input type="email" name="email" value="{{ old('email') }}" class="neo-input" placeholder="you@example.com" required>
                @error('email')<p class="form-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="form-label">Phone *</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="neo-input" placeholder="+92 300 0000000" required>
            </div>
            <div>
                <label class="form-label">City *</label>
                <select name="city" class="neo-input" required>
                    <option value="">Select a city...</option>
                    @foreach(['Karachi','Lahore','Islamabad','Rawalpindi','Faisalabad','Multan','Peshawar','Quetta'] as $city)
                        <option value="{{ $city }}" {{ old('city') === $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="form-label">Company Name <span class="font-bold normal-case text-gray-500">(Optional)</span></label>
            <input type="text" name="company_name" value="{{ old('company_name') }}" class="neo-input" placeholder="Your Company Ltd.">
        </div>

        <div>
            <label class="form-label">Address *</label>
            <textarea name="address" rows="2" class="neo-input" placeholder="123 Main Street..." required>{{ old('address') }}</textarea>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="form-label">Password *</label>
                <input type="password" name="password" class="neo-input" placeholder="Min 8 characters" required>
                @error('password')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="form-label">Confirm Password *</label>
                <input type="password" name="password_confirmation" class="neo-input" placeholder="Repeat password" required>
            </div>
        </div>

        <button type="submit" class="neo-btn w-full bg-green-400 text-black py-4 text-base mt-2">
            Create Account →
        </button>
    </form>

    <div class="mt-8 pt-6 border-t-4 border-black text-center">
        <p class="font-bold">Already have an account?
            <a href="{{ route('login') }}" class="font-black underline underline-offset-4 decoration-2">Sign in</a>
        </p>
    </div>
</div>
@endsection
