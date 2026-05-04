<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (auth()->attempt($validated)) {
            $request->session()->regenerate();
            $user = auth()->user();

            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect('/admin/dashboard');
            } elseif ($user->isAgent()) {
                return redirect('/agent/dashboard');
            } else {
                return redirect('/dashboard');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'role' => 'customer',
            'status' => 'active',
        ]);

        // Create customer record
        Customer::create([
            'user_id' => $user->id,
            'company_name' => $validated['company_name'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'city' => $validated['city'],
        ]);

        auth()->login($user);
        return redirect('/dashboard')->with('success', 'Registration successful!');
    }

    public function dashboard()
    {
        $user = auth()->user();
        $customer = $user->customer;
        $shipments = collect();

        if ($customer) {
            $shipments = $customer->sentShipments()
                ->with('sender', 'receiver', 'tracking')
                ->latest()
                ->take(10)
                ->get();
        }

        return view('customer.dashboard', compact('user', 'customer', 'shipments'));
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully');
    }

    public function profile()
    {
        $user = auth()->user();
        $customer = $user->customer;
        return view('auth.profile', compact('user', 'customer'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user->update($validated);

        if ($user->customer) {
            $user->customer->update([
                'phone' => $validated['phone'],
                'city' => $validated['city'],
            ]);
        }

        return back()->with('success', 'Profile updated successfully');
    }
}
