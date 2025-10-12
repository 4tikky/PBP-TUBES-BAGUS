<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="flex min-h-screen">
            <aside class="w-64 bg-blue-800 text-white p-6 fixed h-full shadow-lg hidden md:block">
                <a href="{{ route('home') }}" class="flex items-center mb-10">
                    <x-application-logo class="block h-10 w-auto fill-current text-white" />
                    <span class="ml-3 font-bold text-xl">Gerai Kita</span>
                </a>

                <nav class="space-y-2">
                {{-- Link Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center px-4 py-2.5 rounded-lg transition-colors
                        {{ request()->routeIs('admin.dashboard') 
                            ? 'bg-gray-900 text-white font-medium' 
                            : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt mr-3 w-5 text-center
                    {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400' }}">
                    </i>
                    <span>Dashboard</span>
                </a>

                {{-- Link Produk --}}
                <a href="{{ route('admin.products.index') }}" 
                class="flex items-center px-4 py-2.5 rounded-lg transition-colors
                        {{ request()->routeIs('admin.products.*') 
                            ? 'bg-gray-900 text-white font-medium' 
                            : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-box-open mr-3 w-5 text-center
                    {{ request()->routeIs('admin.products.*') ? 'text-white' : 'text-gray-400' }}">
                    </i>
                    <span>Produk</span>
                </a>

                {{-- Link Pesanan --}}
                <a href="{{ route('admin.orders.index') }}" 
                class="flex items-center px-4 py-2.5 rounded-lg transition-colors
                        {{ request()->routeIs('admin.orders.*') 
                            ? 'bg-gray-900 text-white font-medium' 
                            : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-receipt mr-3 w-5 text-center
                    {{ request()->routeIs('admin.orders.*') ? 'text-white' : 'text-gray-400' }}">
                    </i>
                    <span>Pesanan</span>
                </a>

                {{-- Link Pelanggan --}}
                <a href="{{ route('admin.customers.index') }}" 
                class="flex items-center px-4 py-2.5 rounded-lg transition-colors
                        {{ request()->routeIs('admin.customers.*') 
                            ? 'bg-gray-900 text-white font-medium' 
                            : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-users mr-3 w-5 text-center
                    {{ request()->routeIs('admin.customers.*') ? 'text-white' : 'text-gray-400' }}">
                    </i>
                    <span>Pelanggan</span>
                </a>
            </nav>
            </aside>

            <div class="flex-1 md:ml-64">
                <header class="bg-white shadow-sm sticky top-0 z-10">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">
                        {{-- Header Slot --}}
                        <div class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $header ?? '' }}
                        </div>

                        {{-- User Dropdown --}}
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    @if (Route::has('profile.edit'))
                                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </header>

                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>