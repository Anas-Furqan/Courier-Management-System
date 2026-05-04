<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forbidden - Access Denied</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen flex items-center justify-center px-4 py-10">
    <div class="max-w-3xl w-full">
        <div class="border-4 border-black bg-white p-12" style="box-shadow: 8px 8px 0 #000;">
            <div class="text-center">
                <p class="text-8xl font-black" style="color: #EF4444;">403</p>
                <h1 class="mt-6 text-4xl font-black">Access Denied</h1>
                <p class="mt-4 text-lg font-bold text-gray-600">You do not have permission to view this resource.</p>
                <div class="mt-10 flex justify-center gap-4 flex-wrap">
                    <a class="neo-btn px-6 py-3" href="{{ route('dashboard') }}" style="background-color: #3B82F6; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: white;">Go to Dashboard</a>
                    <a class="neo-btn px-6 py-3" href="{{ url('/') }}" style="background-color: #E5E7EB; border-width: 4px; border-color: black; box-shadow: 6px 6px 0 0 #000; color: black;">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
