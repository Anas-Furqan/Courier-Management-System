<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DeliverIt') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,900|space-grotesk:400,500,700&display=swap" rel="stylesheet">

    {{-- Tailwind CDN — handles ALL utility classes --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- App JS (CSRF / axios) --}}
    @vite(['resources/js/app.js'])

    {{--
        Custom design-system classes.
        Uses <style type="text/tailwindcss"> so the CDN runtime resolves
        @apply — no build step required.
    --}}
    <style type="text/tailwindcss">
        @layer base {
            body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
            h1, h2, h3, h4, h5, h6 { font-family: 'Space Grotesk', 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
        }

        @layer components {
            /* ── BUTTONS ─────────────────────────── */
            .neo-btn {
                @apply inline-flex items-center justify-center gap-2 border-4 border-black px-5 py-3 font-black uppercase tracking-wide cursor-pointer select-none;
                box-shadow: 4px 4px 0 0 #000;
                transition: transform .1s, box-shadow .1s;
            }
            .neo-btn:hover  { transform: translate(-2px,-2px); box-shadow: 6px 6px 0 0 #000; }
            .neo-btn:active { transform: translate( 2px, 2px); box-shadow: 2px 2px 0 0 #000; }

            .neo-btn-sm {
                @apply inline-flex items-center justify-center gap-1 border-2 border-black px-3 py-1.5 text-xs font-black uppercase tracking-wide cursor-pointer select-none;
                box-shadow: 3px 3px 0 0 #000;
                transition: transform .1s, box-shadow .1s;
            }
            .neo-btn-sm:hover  { transform: translate(-1px,-1px); box-shadow: 4px 4px 0 0 #000; }
            .neo-btn-sm:active { transform: translate( 1px, 1px); box-shadow: 1px 1px 0 0 #000; }

            /* ── CARDS ───────────────────────────── */
            .neo-card    { @apply border-4 border-black bg-white; box-shadow: 6px 6px 0 0 #000; }
            .neo-card-xl { @apply border-4 border-black bg-white; box-shadow: 8px 8px 0 0 #000; }

            /* ── INPUTS ──────────────────────────── */
            .neo-input {
                @apply w-full border-4 border-black bg-white px-4 py-3 font-bold text-black placeholder-gray-400;
                box-shadow: 3px 3px 0 0 #000;
                outline: none;
                transition: box-shadow .1s;
            }
            .neo-input:focus { box-shadow: inset 2px 2px 0 0 rgba(0,0,0,.07), 5px 5px 0 0 #000; }

            /* ── PAGE HERO ───────────────────────── */
            .page-hero { @apply border-4 border-black p-8; box-shadow: 8px 8px 0 0 #000; }

            /* ── TABLES ──────────────────────────── */
            .neo-table-wrap { @apply border-4 border-black bg-white overflow-hidden; box-shadow: 8px 8px 0 0 #000; }
            .neo-table-head { @apply border-b-4 border-black p-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between; }
            .neo-table                { @apply w-full; }
            .neo-table thead tr       { @apply border-b-4 border-black bg-gray-100; }
            .neo-table thead th       { @apply px-6 py-4 text-left font-black text-xs uppercase tracking-widest; }
            .neo-table tbody tr       { @apply border-b-2 border-gray-100 hover:bg-yellow-50 transition-colors; }
            .neo-table tbody td       { @apply px-6 py-4 font-bold text-sm; }
            .neo-table tbody tr:last-child { @apply border-b-0; }

            /* ── STATUS BADGES ───────────────────── */
            .s-badge      { @apply inline-block border-2 border-black px-3 py-1 text-xs font-black uppercase tracking-wide; }
            .s-pending    { @apply s-badge bg-yellow-300; }
            .s-in_transit { @apply s-badge bg-cyan-400; }
            .s-delivered  { @apply s-badge bg-green-400; }
            .s-cancelled  { @apply s-badge bg-red-500 text-white; }
            .s-active     { @apply s-badge bg-green-400; }
            .s-inactive   { @apply s-badge bg-gray-300; }

            /* ── ALERTS ──────────────────────────── */
            .alert-success { @apply border-4 border-black p-4 bg-green-300 font-bold flex items-start gap-3; box-shadow: 4px 4px 0 0 #000; }
            .alert-error   { @apply border-4 border-black p-4 bg-red-300   font-bold flex items-start gap-3; box-shadow: 4px 4px 0 0 #000; }

            /* ── SIDEBAR LINKS ───────────────────── */
            .sidebar-link {
                @apply flex items-center gap-3 px-4 py-3 font-bold text-black border-b border-gray-100 hover:bg-yellow-50 transition-colors text-sm;
            }
            .sidebar-link.active {
                @apply bg-yellow-300 font-black border-l-4 border-l-black;
            }
            .sidebar-section {
                @apply px-4 py-2 text-xs font-black uppercase tracking-widest text-gray-500 bg-gray-50 border-y border-gray-100;
            }

            /* ── FORMS ───────────────────────────── */
            .form-label { @apply block text-sm font-black uppercase tracking-wide mb-2; }
            .form-error { @apply mt-1 text-sm font-bold text-red-600; }

            /* ── INFO / DETAIL CARDS ─────────────── */
            .info-card  { @apply border-4 border-black bg-white p-6; box-shadow: 4px 4px 0 0 #000; }
            .info-label { @apply text-xs font-black uppercase tracking-widest text-gray-500 mb-2; }
            .info-value { @apply text-xl font-black; }

            /* ── STAT CARDS ──────────────────────── */
            .stat-neo       { @apply border-4 border-black p-6; box-shadow: 6px 6px 0 0 #000; }
            .stat-neo-label { @apply text-xs font-black uppercase tracking-widest mb-3; }
            .stat-neo-value { @apply text-5xl font-black leading-none; }

            /* ── TRACKING TIMELINE ───────────────── */
            .track-event { @apply relative pl-8 pb-6; }
            .track-event::before {
                content: '';
                @apply absolute left-0 top-1.5 w-4 h-4 border-4 border-black bg-yellow-300;
            }
            .track-event::after {
                content: '';
                @apply absolute bg-black;
                left: 6px; top: 22px; width: 4px; bottom: 0;
            }
            .track-event:last-child::after { display: none; }

            /* ── MISC ────────────────────────────── */
            .section-title { @apply text-2xl font-black pb-3 mb-6 border-b-4 border-black; }
        }
    </style>
</head>
<body class="bg-white text-black">

<div class="flex min-h-screen">

    {{-- ═══════════════════════════════════════
         DESKTOP SIDEBAR
         Visibility controlled via JS / localStorage.
         Default: visible (flex) on md+, hidden on mobile.
    ═══════════════════════════════════════ --}}
    <aside id="desktop-sidebar"
           class="w-64 border-r-4 border-black flex flex-col flex-shrink-0 sticky top-0 h-screen overflow-y-auto"
           style="display:none">{{-- JS will set flex on md+ --}}

        {{-- Brand --}}
        <div class="border-b-4 border-black p-5 flex items-center gap-3">
            <div class="w-11 h-11 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-sm flex-shrink-0"
                 style="box-shadow:3px 3px 0 #000;">DI</div>
            <a href="/" class="font-black text-lg leading-tight">DeliverIt</a>
        </div>

        {{-- User Badge --}}
        <div class="border-b-4 border-black px-5 py-4 bg-gray-50">
            <p class="text-xs font-black uppercase tracking-widest text-gray-500 mb-1">Logged in as</p>
            <p class="font-black text-sm truncate">{{ auth()->user()->name }}</p>
            <span class="inline-block mt-1 px-2 py-0.5 text-xs font-black uppercase border-2 border-black
                @if(auth()->user()->isAdmin()) bg-purple-300
                @elseif(auth()->user()->isAgent()) bg-cyan-300
                @else bg-yellow-300
                @endif">
                @if(auth()->user()->isAdmin()) Admin
                @elseif(auth()->user()->isAgent()) Agent
                @else Customer
                @endif
            </span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1">
            <a href="{{ route('dashboard') }}"
               class="sidebar-link {{ str_starts_with(Route::currentRouteName() ?? '', 'dashboard') ? 'active' : '' }}">
                <span>📊</span> Dashboard
            </a>

            @if(auth()->user()->isAdmin())
                <div class="sidebar-section">Shipments</div>
                <a href="{{ route('couriers.index') }}"  class="sidebar-link {{ Route::currentRouteName() === 'couriers.index'  ? 'active' : '' }}"><span>📦</span> All Shipments</a>
                <a href="{{ route('couriers.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'couriers.create' ? 'active' : '' }}"><span>➕</span> New Shipment</a>

                <div class="sidebar-section">Management</div>
                <a href="{{ route('admin.agents.index') }}"    class="sidebar-link {{ str_starts_with(Route::currentRouteName() ?? '', 'admin.agents')    ? 'active' : '' }}"><span>👥</span> Agents</a>
                <a href="{{ route('admin.customers.index') }}" class="sidebar-link {{ str_starts_with(Route::currentRouteName() ?? '', 'admin.customers') ? 'active' : '' }}"><span>🏢</span> Customers</a>

                <div class="sidebar-section">Reports</div>
                <a href="{{ route('admin.reports.index') }}"  class="sidebar-link {{ Route::currentRouteName() === 'admin.reports.index'  ? 'active' : '' }}"><span>📈</span> View Reports</a>
                <a href="{{ route('admin.reports.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'admin.reports.create' ? 'active' : '' }}"><span>📊</span> Generate Report</a>

            @elseif(auth()->user()->isAgent())
                <div class="sidebar-section">Shipments</div>
                <a href="{{ route('agent.couriers.index') }}"  class="sidebar-link {{ Route::currentRouteName() === 'agent.couriers.index'  ? 'active' : '' }}"><span>📦</span> All Shipments</a>
                <a href="{{ route('agent.couriers.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.couriers.create' ? 'active' : '' }}"><span>➕</span> New Shipment</a>

                <div class="sidebar-section">Reports</div>
                <a href="{{ route('agent.reports.index') }}"  class="sidebar-link {{ Route::currentRouteName() === 'agent.reports.index'  ? 'active' : '' }}"><span>📈</span> View Reports</a>
                <a href="{{ route('agent.reports.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.reports.create' ? 'active' : '' }}"><span>📊</span> Generate Report</a>

            @else
                <div class="sidebar-section">Quick Actions</div>
                <a href="{{ route('track.search') }}"     class="sidebar-link {{ Route::currentRouteName() === 'track.search'      ? 'active' : '' }}"><span>🔍</span> Track Shipment</a>
                <a href="{{ route('customer.shipments') }}" class="sidebar-link {{ Route::currentRouteName() === 'customer.shipments' ? 'active' : '' }}"><span>📬</span> My Shipments</a>
            @endif
        </nav>

        {{-- Bottom Actions --}}
        <div class="border-t-4 border-black p-4 space-y-2">
            <a href="{{ route('profile') }}" class="neo-btn-sm w-full bg-blue-300 text-black text-center block">👤 Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="neo-btn-sm w-full bg-red-500 text-white">Logout</button>
            </form>
        </div>
    </aside>

    {{-- ═══════════════════════════════════════
         MAIN CONTENT COLUMN
    ═══════════════════════════════════════ --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- ── MOBILE HEADER (hidden on md+) ── --}}
        <header class="md:hidden sticky top-0 z-50 border-b-4 border-black bg-white">
            <div class="px-4 py-3 flex items-center justify-between gap-3">
                <button id="mobile-toggle"
                        class="w-10 h-10 border-2 border-black flex items-center justify-center font-black text-lg hover:bg-yellow-50"
                        style="box-shadow:2px 2px 0 #000;"
                        aria-label="Open menu">☰</button>
                <a href="/" class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-xs"
                         style="box-shadow:2px 2px 0 #000;">DI</div>
                    <span class="font-black">DeliverIt</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="px-3 py-1 bg-red-500 text-white font-black border-2 border-black text-xs"
                            style="box-shadow:2px 2px 0 #000;">Out</button>
                </form>
            </div>
        </header>

        {{-- ── DESKTOP HEADER (hidden on mobile) ── --}}
        <div class="hidden md:flex items-center justify-between border-b-4 border-black px-6 py-3 bg-white sticky top-0 z-40">
            <div class="flex items-center gap-4">
                {{-- HAMBURGER — toggles desktop sidebar --}}
                <button id="desktop-toggle"
                        title="Toggle sidebar"
                        class="w-10 h-10 border-2 border-black flex items-center justify-center font-black text-lg hover:bg-yellow-50 transition-colors"
                        style="box-shadow:2px 2px 0 #000;">☰</button>
                <span class="font-bold text-sm text-gray-500">@yield('page-title', 'Dashboard')</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('profile') }}" class="neo-btn-sm bg-blue-300 text-black">👤 {{ auth()->user()->name }}</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="neo-btn-sm bg-red-500 text-white">Logout</button>
                </form>
            </div>
        </div>

        {{-- ── CONTENT ── --}}
        <main class="flex-1 px-6 py-8 md:px-8 md:py-10">

            @if(session('success'))
                <div class="alert-success mb-6"><span>✓</span> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error mb-6"><span>✕</span> {{ session('error') }}</div>
            @endif

            @yield('content')
        </main>

        {{-- ── FOOTER ── --}}
        <footer class="border-t-4 border-black bg-gray-50 py-5 px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-2">
                <p class="font-bold text-sm">© 2026 <span class="font-black">DeliverIt</span> Courier Management System.</p>
                <a href="/" class="text-sm font-bold hover:underline underline-offset-4 decoration-2">← Back to Home</a>
            </div>
        </footer>
    </div>
</div>

{{-- ═══════════════════════════════════════
     MOBILE SIDEBAR (overlay)
═══════════════════════════════════════ --}}
<div id="sidebar-overlay" class="fixed inset-0 z-40 hidden" style="background:rgba(0,0,0,.6);"></div>

<aside id="mobile-sidebar"
       class="fixed left-0 top-0 h-screen w-72 bg-white border-r-4 border-black z-50 flex flex-col overflow-y-auto"
       style="transform:translateX(-100%); transition:transform .25s ease;">

    <div class="border-b-4 border-black p-5 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 bg-yellow-300 border-4 border-black flex items-center justify-center font-black text-sm"
                 style="box-shadow:3px 3px 0 #000;">DI</div>
            <span class="font-black text-lg">DeliverIt</span>
        </div>
        <button id="sidebar-close"
                class="w-9 h-9 border-2 border-black flex items-center justify-center font-black hover:bg-gray-100"
                style="box-shadow:2px 2px 0 #000;">✕</button>
    </div>

    <div class="border-b-4 border-black px-5 py-4 bg-gray-50">
        <p class="text-xs font-black uppercase tracking-widest text-gray-500 mb-1">Logged in as</p>
        <p class="font-black">{{ auth()->user()->name }}</p>
    </div>

    <nav class="flex-1">
        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ str_starts_with(Route::currentRouteName() ?? '', 'dashboard') ? 'active' : '' }}">
            <span>📊</span> Dashboard
        </a>

        @if(auth()->user()->isAdmin())
            <div class="sidebar-section">Shipments</div>
            <a href="{{ route('couriers.index') }}"  class="sidebar-link {{ Route::currentRouteName() === 'couriers.index'  ? 'active' : '' }}"><span>📦</span> All Shipments</a>
            <a href="{{ route('couriers.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'couriers.create' ? 'active' : '' }}"><span>➕</span> New Shipment</a>
            <div class="sidebar-section">Management</div>
            <a href="{{ route('admin.agents.index') }}"    class="sidebar-link {{ str_starts_with(Route::currentRouteName() ?? '', 'admin.agents')    ? 'active' : '' }}"><span>👥</span> Agents</a>
            <a href="{{ route('admin.customers.index') }}" class="sidebar-link {{ str_starts_with(Route::currentRouteName() ?? '', 'admin.customers') ? 'active' : '' }}"><span>🏢</span> Customers</a>
            <div class="sidebar-section">Reports</div>
            <a href="{{ route('admin.reports.index') }}"  class="sidebar-link {{ Route::currentRouteName() === 'admin.reports.index'  ? 'active' : '' }}"><span>📈</span> View Reports</a>
            <a href="{{ route('admin.reports.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'admin.reports.create' ? 'active' : '' }}"><span>📊</span> Generate Report</a>
        @elseif(auth()->user()->isAgent())
            <div class="sidebar-section">Shipments</div>
            <a href="{{ route('agent.couriers.index') }}"  class="sidebar-link {{ Route::currentRouteName() === 'agent.couriers.index'  ? 'active' : '' }}"><span>📦</span> All Shipments</a>
            <a href="{{ route('agent.couriers.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.couriers.create' ? 'active' : '' }}"><span>➕</span> New Shipment</a>
            <div class="sidebar-section">Reports</div>
            <a href="{{ route('agent.reports.index') }}"  class="sidebar-link {{ Route::currentRouteName() === 'agent.reports.index'  ? 'active' : '' }}"><span>📈</span> View Reports</a>
            <a href="{{ route('agent.reports.create') }}" class="sidebar-link {{ Route::currentRouteName() === 'agent.reports.create' ? 'active' : '' }}"><span>📊</span> Generate Report</a>
        @else
            <div class="sidebar-section">Quick Actions</div>
            <a href="{{ route('track.search') }}"       class="sidebar-link {{ Route::currentRouteName() === 'track.search'       ? 'active' : '' }}"><span>🔍</span> Track Shipment</a>
            <a href="{{ route('customer.shipments') }}" class="sidebar-link {{ Route::currentRouteName() === 'customer.shipments' ? 'active' : '' }}"><span>📬</span> My Shipments</a>
        @endif
    </nav>

    <div class="border-t-4 border-black p-4 space-y-2">
        <a href="{{ route('profile') }}" class="neo-btn-sm w-full bg-blue-300 text-black text-center block">👤 Profile</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="neo-btn-sm w-full bg-red-500 text-white">Logout</button>
        </form>
    </div>
</aside>

<script>
(function () {
    /* ─── ELEMENTS ─────────────────────────────── */
    const desktopSidebar = document.getElementById('desktop-sidebar');
    const desktopToggle  = document.getElementById('desktop-toggle');
    const mobileSidebar  = document.getElementById('mobile-sidebar');
    const mobileToggle   = document.getElementById('mobile-toggle');
    const sidebarClose   = document.getElementById('sidebar-close');
    const overlay        = document.getElementById('sidebar-overlay');

    /* ─── DESKTOP SIDEBAR TOGGLE ────────────────
       Uses style.display (inline style wins over all
       Tailwind responsive classes, incl. md:flex).
    ────────────────────────────────────────────── */
    const STORAGE_KEY = 'deliverItSidebarOpen';
    const isDesktop   = () => window.innerWidth >= 768;

    function showDesktopSidebar() {
        desktopSidebar.style.display = 'flex';
        localStorage.setItem(STORAGE_KEY, 'true');
    }
    function hideDesktopSidebar() {
        desktopSidebar.style.display = 'none';
        localStorage.setItem(STORAGE_KEY, 'false');
    }
    function toggleDesktopSidebar() {
        desktopSidebar.style.display === 'none'
            ? showDesktopSidebar()
            : hideDesktopSidebar();
    }

    /* Restore saved state (desktop only) */
    if (isDesktop()) {
        const saved = localStorage.getItem(STORAGE_KEY);
        /* Default: open. Only hide if explicitly saved as closed. */
        saved === 'false' ? hideDesktopSidebar() : showDesktopSidebar();
    }

    desktopToggle && desktopToggle.addEventListener('click', toggleDesktopSidebar);

    /* Re-evaluate on resize */
    window.addEventListener('resize', function () {
        if (!isDesktop()) {
            desktopSidebar.style.display = 'none'; /* always hidden below md */
        } else {
            const saved = localStorage.getItem(STORAGE_KEY);
            saved === 'false' ? hideDesktopSidebar() : showDesktopSidebar();
        }
    });

    /* ─── MOBILE SIDEBAR TOGGLE ─────────────────
       Uses CSS transform (translateX) for smooth slide.
    ────────────────────────────────────────────── */
    function openMobile() {
        mobileSidebar.style.transform = 'translateX(0)';
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeMobile() {
        mobileSidebar.style.transform = 'translateX(-100%)';
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    mobileToggle && mobileToggle.addEventListener('click', openMobile);
    sidebarClose && sidebarClose.addEventListener('click', closeMobile);
    overlay      && overlay.addEventListener('click', closeMobile);
    document.addEventListener('keydown', e => e.key === 'Escape' && closeMobile());
    mobileSidebar && mobileSidebar.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMobile));
})();
</script>
</body>
</html>
