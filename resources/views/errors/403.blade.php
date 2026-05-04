<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forbidden</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen px-4 py-10">
    <div class="mx-auto flex min-h-[80vh] max-w-3xl items-center justify-center">
        <div class="panel-soft w-full p-10 text-center">
            <p class="badge mx-auto bg-rose-400/15 text-rose-200 ring-1 ring-rose-300/20">403</p>
            <h1 class="mt-6 font-display text-4xl font-bold text-white">Access denied</h1>
            <p class="mt-3 text-slate-400">You do not have permission to view this resource.</p>
            <div class="mt-8 flex justify-center gap-3">
                <a class="button-primary" href="{{ route('dashboard') }}">Go to dashboard</a>
                <a class="button-secondary" href="{{ url('/') }}">Back to login</a>
            </div>
        </div>
    </div>
</body>
</html>
