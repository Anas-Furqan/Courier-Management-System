<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DeliverIt - Courier Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Neobrutalism Base Styles */
        .neo-btn {
            @apply border-4 border-black font-black uppercase tracking-wider transition-all;
            box-shadow: 6px 6px 0 0 #000;
        }
        .neo-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0 0 #000;
        }
        .neo-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0 0 #000;
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
<body class="bg-white text-black">
    <!-- Navigation Header -->
    <header class="sticky top-0 z-50 border-b-4 border-black bg-white">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <a href="/" class="flex items-center gap-2">
                        <div class="w-12 h-12 bg-yellow-400 border-4 border-black flex items-center justify-center font-black text-2xl" style="box-shadow: 4px 4px 0 #000;">
                            DI
                        </div>
                        <span class="font-black text-xl hidden md:inline">DeliverIt</span>
                    </a>
                </div>
                <nav class="hidden md:flex items-center gap-8 font-bold">
                    <a href="/" class="hover:underline decoration-4 underline-offset-4">Home</a>
                    <a href="{{ route('track.search') }}" class="hover:underline decoration-4 underline-offset-4">Track</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="hover:underline decoration-4 underline-offset-4">Dashboard</a>
                    @endauth
                </nav>
                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-sm font-bold">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white neo-btn text-sm">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white neo-btn text-sm">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-green-400 text-black neo-btn text-sm">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t-4 border-black bg-gray-100 mt-16">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-black bg-yellow-300 px-3 py-2 inline-block border-4 border-black mb-4" style="box-shadow: 4px 4px 0 #000;">DeliverIt</h3>
                    <p class="font-bold">The only courier system with real guts.</p>
                </div>
                <div>
                    <h4 class="font-black text-lg mb-4 border-b-4 border-black pb-2">Product</h4>
                    <ul class="space-y-2 font-bold">
                        <li><a href="/" class="hover:underline">Features</a></li>
                        <li><a href="/" class="hover:underline">Pricing</a></li>
                        <li><a href="/" class="hover:underline">Security</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-black text-lg mb-4 border-b-4 border-black pb-2">Company</h4>
                    <ul class="space-y-2 font-bold">
                        <li><a href="/" class="hover:underline">About</a></li>
                        <li><a href="/" class="hover:underline">Blog</a></li>
                        <li><a href="/" class="hover:underline">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-black text-lg mb-4 border-b-4 border-black pb-2">Legal</h4>
                    <ul class="space-y-2 font-bold">
                        <li><a href="/" class="hover:underline">Terms</a></li>
                        <li><a href="/" class="hover:underline">Privacy</a></li>
                        <li><a href="/" class="hover:underline">Cookies</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t-4 border-black pt-8 text-center font-bold">
                <p>© 2026 DeliverIt. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>