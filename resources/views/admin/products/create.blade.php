<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Form untuk error handling jika ada --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama Produk</label>
                            <input id="name" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text" name="name" value="{{ old('name') }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="price" class="block font-medium text-sm text-gray-700">Harga</label>
                            <input id="price" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="number" name="price" value="{{ old('price') }}" required />
                        </div>

                        <div class="mt-4">
                            <label for="stock" class="block font-medium text-sm text-gray-700">Stok</label>
                            <input id="stock" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="number" name="stock" value="{{ old('stock') }}" required />
                        </div>

                        <div class="mt-4">
                            <label for="category_id" class="block font-medium text-sm text-gray-700">Kategori</label>
                            <select id="category_id" name="category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">Foto Produk</label>
                            <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.gif,image/jpeg,image/png,image/gif"
    class="block mt-1 w-full text-sm text-gray-500
        file:mr-4 file:py-2 file:px-4
        file:rounded-full file:border-0
        file:text-sm file:font-semibold
        file:bg-blue-50 file:text-blue-700
        hover:file:bg-blue-100" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                                Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>