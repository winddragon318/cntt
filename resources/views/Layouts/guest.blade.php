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
    <body class="font-sans text-gray-900 antialiased">
        <div class="relative flex min-h-screen flex-col items-center overflow-hidden pt-6 sm:justify-center sm:pt-0">
            {{-- Nền phong cách trường học: giấy vở kẻ ngang + màu ấm gợi sân trường --}}
            <div class="pointer-events-none fixed inset-0 -z-10 bg-gradient-to-br from-sky-100 via-amber-50 to-emerald-50"></div>
            <div class="pointer-events-none fixed inset-0 -z-10 bg-[repeating-linear-gradient(transparent,transparent_27px,rgba(100,116,139,0.09)_27px,rgba(100,116,139,0.09)_28px)]"></div>
            <div class="pointer-events-none fixed -bottom-24 -left-20 -z-10 h-72 w-72 rounded-full bg-sky-400/25 blur-3xl"></div>
            <div class="pointer-events-none fixed -right-16 -top-16 -z-10 h-80 w-80 rounded-full bg-amber-300/30 blur-3xl"></div>
            <div class="pointer-events-none fixed bottom-1/3 left-1/2 -z-10 h-64 w-96 -translate-x-1/2 rounded-full bg-emerald-400/15 blur-3xl"></div>

            <div>
                <a href="/">
                    <img src="{{ asset('assets/images/hht.png') }}" alt="Logo HHT"  class="me-3">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
