<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DeliverIt — Fast Courier Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black font-sans">

    {{-- ═══ NAVBAR ═══ --}}
    <header class="sticky top-0 z-50 border-b-4 border-black bg-white">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-6">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3 flex-shrink-0">
                <div class="w-11 h-11 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-sm" style="box-shadow:3px 3px 0 #000;">DI</div>
                <span class="font-black text-xl hidden sm:inline">DeliverIt</span>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden md:flex items-center gap-8 font-bold">
                <a href="/" class="hover:underline decoration-4 underline-offset-4 transition-all">Home</a>
                <a href="{{ route('track.search') }}" class="hover:underline decoration-4 underline-offset-4 transition-all">Track</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:underline decoration-4 underline-offset-4 transition-all">Dashboard</a>
                @endauth
            </nav>

            {{-- Auth Buttons --}}
            <div class="flex items-center gap-3">
                @auth
                    <span class="hidden sm:block text-sm font-bold">{{ auth()->user()->name }}</span>
                    <a href="{{ route('dashboard') }}" class="neo-btn-sm bg-yellow-300 text-black">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="neo-btn-sm bg-red-500 text-white">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="neo-btn-sm bg-blue-500 text-white">Login</a>
                    <a href="{{ route('register') }}" class="neo-btn-sm bg-yellow-300 text-black">Sign Up</a>
                @endauth
            </div>
        </div>
    </header>

    {{-- ═══ MAIN CONTENT ═══ --}}
    <main>
        @yield('content')
    </main>

    {{-- ═══ FOOTER ═══ --}}
    <footer class="border-t-4 border-black bg-gray-50 mt-16">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-10">

                <div class="col-span-2 md:col-span-1">
                    <div class="inline-block mb-4">
                        <span class="bg-yellow-300 border-4 border-black px-3 py-2 font-black text-lg" style="box-shadow:4px 4px 0 #000;">DeliverIt</span>
                    </div>
                    <p class="font-bold text-gray-700 text-sm leading-relaxed">Pakistan's boldest courier management system. Track, manage, deliver.</p>
                </div>

                <div>
                    <h4 class="font-black text-sm uppercase tracking-widest mb-4 border-b-4 border-black pb-2">Product</h4>
                    <ul class="space-y-2 text-sm font-bold text-gray-700">
                        <li><a href="{{ route('track.search') }}" class="hover:underline underline-offset-4">Track Shipment</a></li>
                        <li><a href="{{ route('register') }}" class="hover:underline underline-offset-4">Register</a></li>
                        <li><a href="{{ route('login') }}" class="hover:underline underline-offset-4">Login</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-black text-sm uppercase tracking-widest mb-4 border-b-4 border-black pb-2">Company</h4>
                    <ul class="space-y-2 text-sm font-bold text-gray-700">
                        <li><a href="/" class="hover:underline underline-offset-4">About</a></li>
                        <li><a href="/" class="hover:underline underline-offset-4">Blog</a></li>
                        <li><a href="/" class="hover:underline underline-offset-4">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-black text-sm uppercase tracking-widest mb-4 border-b-4 border-black pb-2">Legal</h4>
                    <ul class="space-y-2 text-sm font-bold text-gray-700">
                        <li><a href="/" class="hover:underline underline-offset-4">Terms</a></li>
                        <li><a href="/" class="hover:underline underline-offset-4">Privacy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t-4 border-black pt-8 flex flex-col sm:flex-row items-center justify-between gap-2">
                <p class="font-bold text-sm">© 2026 DeliverIt. All rights reserved.</p>
                <p class="font-bold text-sm text-gray-500">Built for Pakistan 🇵🇰</p>
            </div>
        </div>
    </footer>

</body>
</html>
