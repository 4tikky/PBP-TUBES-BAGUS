<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white border-b border-blue-600/60 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        {{-- Letakkan file logo di: public/images/logo.svg --}}
                        <img src="{{ asset('images/logo_GK.png') }}" alt="Gerai Kita" class="h-9 w-auto">
                        <span class="text-lg font-semibold">GeraiKita</span>
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <div class="relative">
                        <details class="group">
                            <summary class="list-none cursor-pointer inline-flex items-center gap-2 px-3 py-2 rounded-md bg-white/10 hover:bg-white/20 text-sm text-white">
                                <div class="w-8 h-8 rounded-full bg-white text-blue-600 flex items-center justify-center font-semibold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="font-medium">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 transform group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </summary>
                            <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg p-1 z-50">
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                @else
                                    <a href="{{ route('buyer.dashboard') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                    <a href="{{ route('cart.index') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">Keranjang</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </details>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:underline">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm font-medium hover:underline">Daftar</a>
                    @endif
                @endauth
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/30">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/95 backdrop-blur px-4 pb-3">
        @auth
            <div class="py-3 border-t border-gray-200">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
            </div>
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-sm text-gray-700">Dashboard</a>
            @else
                <a href="{{ route('buyer.dashboard') }}" class="block px-3 py-2 text-sm text-gray-700">Dashboard</a>
                <a href="{{ route('cart.index') }}" class="block px-3 py-2 text-sm text-gray-700">Keranjang</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block w-full text-left px-3 py-2 text-sm text-red-600">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block px-3 py-2 text-sm text-gray-700">Masuk</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="block px-3 py-2 text-sm text-gray-700">Daftar</a>
            @endif
        @endauth
    </div>
</nav>