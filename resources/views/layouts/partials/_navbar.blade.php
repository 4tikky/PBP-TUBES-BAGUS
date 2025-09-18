<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="/" class="text-xl font-bold text-gray-800">UMKM Store</a>
            
            <div class="hidden md:flex items-center space-x-6">
                <a href="/" class="text-gray-600 hover:text-blue-500 transition duration-300">Home</a>
                <a href="/cart" class="text-gray-600 hover:text-blue-500 transition duration-300">Keranjang</a>
                
                {{-- Logika untuk menampilkan menu berdasarkan status login dan role --}}
                @auth
                    {{-- Jika user adalah admin --}}
                    @if(auth()->user()->role == 'admin')
                        <a href="/admin/dashboard" class="text-gray-600 hover:text-blue-500 transition duration-300">Admin Dashboard</a>
                    @endif
                    
                    <span class="text-gray-700">Hi, {{ auth()->user()->name }}</span>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">Logout</button>
                    </form>
                @else
                    <a href="/login" class="text-gray-600 hover:text-blue-500 transition duration-300">Login</a>
                    <a href="/register" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">Register</a>
                @endguest
            </div>
            
            {{-- Tombol menu untuk mobile --}}
            <div class="md:hidden">
                <button class="text-gray-800 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </div>
    </div>
</nav>
