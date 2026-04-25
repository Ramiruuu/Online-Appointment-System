<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-100 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-slate-950 px-4 py-12 relative overflow-hidden">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(14,165,233,0.25),transparent_20%),radial-gradient(circle_at_bottom_right,_rgba(99,102,241,0.24),transparent_25%)]"></div>

            <div class="relative w-full max-w-md rounded-[2rem] border border-white/10 bg-slate-900/95 p-8 shadow-2xl shadow-slate-950/40 backdrop-blur-xl">
                <div class="mb-8 text-center">
                    <a href="/" class="inline-flex items-center justify-center rounded-full bg-cyan-500/15 px-3 py-2 text-sm font-semibold text-cyan-200 backdrop-blur-sm">
                        {{ config('app.name', 'Appointment System') }}
                    </a>
                    <h1 class="mt-6 text-3xl font-semibold text-white">{{ __('Welcome') }}</h1>
                    <p class="mt-2 text-sm text-slate-400">{{ __('Secure access to your appointments and services.') }}</p>
                </div>

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
