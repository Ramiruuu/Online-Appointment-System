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
    <body class="font-sans antialiased bg-slate-950 text-slate-100">
        <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.18),transparent_25%),radial-gradient(circle_at_bottom_right,_rgba(99,102,241,0.18),transparent_25%),#0f172a]">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-slate-900/95 border-b border-slate-800 shadow-sm backdrop-blur-xl">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-10">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
