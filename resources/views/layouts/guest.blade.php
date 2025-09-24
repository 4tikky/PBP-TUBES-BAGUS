<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100">

        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-gray-800" />
                        </a>
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <span class="font-semibold text-xl text-gray-800">Gerai Kita</span>
                            <span class="mx-2 text-gray-300">|</span>
                            <span class="text-sm text-gray-600">Telp: 0812-3456-7890</span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

    </body>
</html>