<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mi Agenda') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-950">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-950 via-[#0A1A3C] to-gray-950 px-4">
            <div>
                <a href="/" class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-600/30">
                        A
                    </div>
                    <div>
                        <span class="font-bold text-xl text-white tracking-tight block leading-none">Mi Agenda</span>
                        <span class="text-xs text-blue-300">Organiza tu tiempo</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-7 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>