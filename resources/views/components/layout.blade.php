<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-[#F3F4F7] text-secondary">
    <x-the-header />
    <main class="flex-1 w-full">
        <div class="max-w-6xl mx-auto px-6 py-10">
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-900/5 p-8">
                {{ $slot }}
            </div>
        </div>
    </main>
    <x-the-footer />
</body>
</html>
