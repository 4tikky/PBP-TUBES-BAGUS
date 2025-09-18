<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UMKM Mini-Commerce')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    {{-- Memasukkan komponen Navbar --}}
    @include('layouts.partials._navbar')

    <main class="container mx-auto px-4 py-8">
        {{-- Konten utama dari setiap halaman akan dimuat di sini --}}
        @yield('content')
    </main>

    <footer class="bg-white shadow-inner mt-12 py-6">
        <div class="container mx-auto px-4 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} UMKM Mini-Commerce. Dibuat untuk Proyek PBP 2025.</p>
        </div>
    </footer>

</body>
</html>
