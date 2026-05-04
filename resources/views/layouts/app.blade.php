<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DeliverIt') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .neo-btn {
            @apply border-4 border-black font-black uppercase tracking-wider transition-all;
            box-shadow: 6px 6px 0 0 #000;
        }
        .neo-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0 0 #000;
        }
        .neo-card {
            @apply border-4 border-black p-6;
            box-shadow: 6px 6px 0 0 #000;
        }
        .neo-input {
            @apply border-4 border-black px-4 py-3 font-bold;
            box-shadow: 4px 4px 0 0 #000;
        }
        .neo-input:focus {
            outline: none !important;
            box-shadow: inset 2px 2px 0 0 rgba(0,0,0,0.1), 6px 6px 0 0 #000 !important;
        }
    </style>
</head>
<body class="bg-white text-black font-sans">
    <!-- Navigation -->
    <header class="sticky top-0 z-50 border-b-4 border-black bg-white">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-12 h-12 bg-yellow-400 border-4 border-black flex items-center justify-center font-black" style="box-shadow: 4px 4px 0 #000;">
                        DI
                    </div>
                    <span class="font-black text-xl hidden md:inline">DeliverIt</span>
                </a>

                <nav class="hidden md:flex items-center gap-8 font-bold">
                    <a href="{{ route('track.search') }}" class="hover:underline">Track</a>
                    <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:underline">Admin</a>
                    @elseif(auth()->user()->isAgent())
                        <a href="/agent/dashboard" class="hover:underline">Agent</a>
                    @endif
                </nav>

                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white neo-btn text-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-300 border-4 border-black font-bold" style="box-shadow: 4px 4px 0 #000;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 p-4 bg-red-300 border-4 border-black font-bold" style="box-shadow: 4px 4px 0 #000;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t-4 border-black bg-gray-100 mt-16 py-8">
        <div class="container mx-auto px-6 text-center font-bold">
            <p>© 2026 DeliverIt Courier Management System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>