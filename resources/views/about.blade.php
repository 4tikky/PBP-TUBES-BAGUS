<x-guest-layout>
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Halaman --}}
            <div class="text-center mb-16 animate-fade-in">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900">
                    Tentang Gerai Kita
                </h1>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">
                    Misi kami adalah memberdayakan UMKM lokal dengan menyediakan platform digital untuk menjangkau lebih banyak pelanggan.
                </p>
            </div>

            {{-- Bagian Misi Kami --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Misi Kami</h2>
                    <p class="text-gray-600 mb-4">
                        Gerai Kita lahir dari semangat untuk mendukung pertumbuhan ekonomi lokal. Kami percaya bahwa produk sembako dan jajanan dari UMKM memiliki kualitas terbaik. Oleh karena itu, kami berkomitmen untuk menjadi jembatan antara produsen lokal dan Anda, para pelanggan setia.
                    </p>
                    <p class="text-gray-600">
                        Setiap pembelian Anda di Gerai Kita tidak hanya memenuhi kebutuhan harian, tetapi juga secara langsung membantu keberlangsungan usaha kecil di sekitar kita.
                    </p>
                </div>
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('images/toko.jpg') }}" alt="Gambar Gerai Kita">
                </div>
            </div>

            {{-- Bagian Nilai-Nilai Kami --}}
            <div class="text-center mb-20">
                 <h2 class="text-3xl font-bold text-gray-800 mb-8">Nilai-Nilai Kami</h2>
                 <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                     <div class="bg-blue-50 p-6 rounded-lg">
                         <h3 class="text-xl font-semibold text-blue-800 mb-2">Kualitas Terjamin</h3>
                         <p class="text-gray-600">Kami bekerja sama langsung dengan UMKM untuk memastikan setiap produk memenuhi standar kualitas terbaik.</p>
                     </div>
                     <div class="bg-blue-50 p-6 rounded-lg">
                         <h3 class="text-xl font-semibold text-blue-800 mb-2">Pemberdayaan Lokal</h3>
                         <p class="text-gray-600">Kami berkomitmen untuk mendukung dan memajukan ekonomi para pelaku usaha kecil di Indonesia.</p>
                     </div>
                     <div class="bg-blue-50 p-6 rounded-lg">
                         <h3 class="text-xl font-semibold text-blue-800 mb-2">Pelayanan Terbaik</h3>
                         <p class="text-gray-600">Kepuasan Anda adalah prioritas kami. Kami siap melayani dengan ramah dan responsif.</p>
                     </div>
                 </div>
            </div>

        </div>
    </div>
</x-guest-layout>