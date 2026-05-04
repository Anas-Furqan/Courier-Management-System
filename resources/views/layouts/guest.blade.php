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
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="guest-shell text-slate-100 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950">
    <style>
        .glass-panel { @apply rounded-2xl border border-white/10 bg-white/5 shadow-2xl backdrop-blur-xl; }
        .hero-panel { @apply glass-panel flex flex-col gap-6 p-6 md:flex-row md:items-center md:justify-between; }
        .section-kicker { @apply text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/80; }
        .btn-primary { @apply inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 px-6 py-3 text-sm font-semibold text-white transition duration-300 hover:shadow-lg hover:shadow-cyan-500/30; }
        .btn-secondary { @apply inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 px-6 py-3 text-sm font-semibold text-white transition duration-300 hover:bg-white/10; }
        .input-label { @apply mb-2 block text-sm font-medium text-slate-300; }
        .input-field { @apply w-full rounded-lg border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none transition placeholder:text-slate-500 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20; }
        .badge { @apply rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-slate-200; }
        .feature-card { @apply rounded-lg border border-white/10 bg-white/5 p-4 text-sm leading-6 text-slate-200 backdrop-blur; }
    </style>
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,0.22),_transparent_34%),radial-gradient(circle_at_bottom_right,_rgba(59,130,246,0.22),_transparent_30%)]"></div>
        <div class="relative mx-auto flex min-h-screen max-w-7xl items-center px-4 py-12 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </div>
</body>
</html>