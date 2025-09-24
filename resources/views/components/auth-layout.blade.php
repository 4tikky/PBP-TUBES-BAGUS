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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            <div class="hidden md:flex w-full md:w-1/2 bg-white justify-center items-center">
                <div class="text-center">
                    <a href="/">
                        <x-application-logo class="w-60 h-60 text-gray-800 mx-auto" />
                    </a>
                    <p class="text-blue-900 text-2xl mt-6 font-semibold">
                        UMKM Jaya, Rakyat Sejahtera
                    </p>
                </div>
            </div>

            <div class="w-full md:w-1/2 flex justify-center items-center bg-blue-200">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>