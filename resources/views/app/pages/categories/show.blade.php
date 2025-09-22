{{-- Memberitahu Blade untuk menggunakan kerangka utama dari folder layouts --}}
@extends('app.layouts.app')

{{-- Mengatur judul spesifik untuk halaman ini --}}
@section('title', 'Detail Kategori: ' . $category->name)

{{-- Ini adalah bagian konten yang akan dimasukkan ke @yield('content') di layout utama --}}
@section('content')

<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">

        {{-- Header Halaman --}}
        <div class="mb-4">
            <h1 class="text-xl font-bold text-gray-900 sm:text-2xl dark:text-white">Detail Kategori</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Informasi lengkap untuk kategori <span class="font-semibold">{{ $category->name }}</span>.</p>
        </div>

        {{-- Kartu Detail Kategori --}}
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-4 mb-4">
            <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $category->name }}</h5>
            <p class="text-gray-600 dark:text-gray-400">
                {{ $category->description ?: 'Tidak ada deskripsi untuk kategori ini.' }}
            </p>
            <hr class="my-4 dark:border-gray-700">
            <div class="flex items-center space-x-4">
                <div class="text-sm">
                    <span class="font-semibold text-gray-900 dark:text-white">Jumlah Produk:</span>
                    <span class="text-gray-600 dark:text-gray-400">{{ $category->products->count() }}</span>
                </div>
                 <div class="text-sm">
                    <span class="font-semibold text-gray-900 dark:text-white">Dibuat pada:</span>
                    <span class="text-gray-600 dark:text-gray-400">{{ $category->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        {{-- Kartu Daftar Produk Terkait --}}
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
             <div class="p-4 border-b dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Produk dalam Kategori Ini
                </h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Produk</th>
                            <th scope="col" class="px-4 py-3">SKU</th>
                            <th scope="col" class="px-4 py-3">Supplier</th>
                            <th scope="col" class="px-4 py-3">Harga Jual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($category->products as $product)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->name }}</th>
                                <td class="px-4 py-3">{{ $product->sku }}</td>
                                <td class="px-4 py-3">{{ $product->supplier->name ?? '-' }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                             <tr>
                                <td colspan="4" class="py-8 px-4 text-center">
                                    <h5 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Belum Ada Produk</h5>
                                    <p class="font-normal text-gray-500">Tidak ada produk yang terdaftar dalam kategori ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-4">
             <a href="{{ route('categories.index') }}" class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-800 dark:text-primary-500 dark:hover:text-primary-700">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                Kembali ke Daftar Kategori
            </a>
        </div>
    </div>
</section>

@endsection
