<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Courier Management System') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            background-attachment: fixed;
        }
        .glass-panel {
            @apply rounded-2xl border border-white/10 bg-white/5 shadow-2xl backdrop-blur-xl;
        }
        .btn-primary {
            @apply px-6 py-3 rounded-lg font-semibold text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 hover:-translate-y-0.5;
        }
        .btn-secondary {
            @apply px-6 py-3 rounded-lg font-semibold border border-white/20 text-white hover:bg-white/5 transition-all duration-300;
        }
        .nav-link {
            @apply text-slate-300 hover:text-white transition px-3 py-2 rounded-lg hover:bg-white/5;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-shell text-slate-100 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950">
    <style>
        .glass-panel { @apply rounded-2xl border border-white/10 bg-white/5 shadow-2xl backdrop-blur-xl; }
        .hero-panel { @apply glass-panel flex flex-col gap-6 p-6 md:flex-row md:items-center md:justify-between; }
        .section-kicker { @apply text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/80; }
        .btn-primary { @apply inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 px-6 py-3 text-sm font-semibold text-white transition duration-300 hover:shadow-lg hover:shadow-cyan-500/30; }
        .btn-secondary { @apply inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 px-6 py-3 text-sm font-semibold text-white transition duration-300 hover:bg-white/10; }
        .input-label { @apply mb-2 block text-sm font-medium text-slate-300; }
        .input-field { @apply w-full rounded-lg border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none transition placeholder:text-slate-500 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20; }
        .stat-card { @apply glass-panel p-6; }
        .stat-label { @apply text-xs uppercase tracking-[0.3em] text-slate-400; }
        .stat-value { @apply mt-3 text-3xl font-black text-white; }
        .status-pill { @apply inline-flex rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em]; }
        .status-pending { @apply bg-amber-400/15 text-amber-200; }
        .status-in_transit { @apply bg-cyan-400/15 text-cyan-200; }
        .status-delivered { @apply bg-emerald-400/15 text-emerald-200; }
        .status-cancelled { @apply bg-rose-400/15 text-rose-200; }
        .timeline-item { @apply relative flex gap-4 rounded-lg border border-white/10 bg-white/5 p-4; }
        .timeline-dot { @apply mt-1 h-3 w-3 rounded-full bg-cyan-300 shadow-[0_0_0_6px_rgba(34,211,238,0.12)]; }
        .nav-link { @apply text-slate-300 hover:text-white transition px-3 py-2 rounded-lg hover:bg-white/5; }
    </style>
    <div class="min-h-screen">
        <header class="sticky top-0 z-40 border-b border-white/10 bg-slate-950/85 backdrop-blur-xl">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <span class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-br from-cyan-400 via-sky-500 to-indigo-600 text-sm font-black text-white shadow-lg shadow-cyan-500/30">CM</span>
                    <div>
                        <p class="text-sm uppercase tracking-[0.35em] text-cyan-300/80">Courier Management</p>
                        <p class="text-lg font-semibold text-white">VIP Control Center</p>
                    </div>
                </a>

                <nav class="hidden items-center gap-6 md:flex">
                    <a href="{{ url('/track') }}" class="nav-link">Track</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ url('/admin/dashboard') }}" class="nav-link">Admin</a>
                        @elseif(auth()->user()->isAgent())
                            <a href="{{ url('/agent/dashboard') }}" class="nav-link">Agent</a>
                        @endif
                    @endauth
                </nav>

                <div class="flex items-center gap-3">
                    @auth
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button class="rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/10">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/10">Login</a>
                        <a href="{{ route('register') }}" class="rounded-full bg-cyan-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">Register</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-emerald-200" data-reveal>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-2xl border border-rose-400/20 bg-rose-400/10 px-4 py-3 text-rose-200" data-reveal>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>