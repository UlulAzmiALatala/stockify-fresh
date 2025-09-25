@extends('app.layouts.app')

@section('title', 'Daftar Produk')

@section('content')

<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            
            {{-- Header Tabel: Search dan Judul --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Daftar Semua Produk
                        <span class="text-gray-500">({{ $products->total() }})</span>
                    </h5>
                </div>
                <div class="w-full md:w-1/2">
                    <form action="{{ route('products.index') }}" method="GET" class="flex items-center">
                        <label for="simple-search" class="sr-only">Cari</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                            </div>
                            <input type="text" name="search" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari produk..." value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- Tabel Produk (Read-Only) --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Produk</th>
                            <th scope="col" class="px-4 py-3">Kategori</th>
                            <th scope="col" class="px-4 py-3">Harga Jual</th>
                            <th scope="col" class="px-4 py-3">Stok</th>
                            <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->name }}</th>
                                <td class="px-4 py-3">{{ $product->category->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ 'Rp ' . number_format($product->selling_price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ $product->stock }}</td>
                                <td class="px-4 py-3 text-right">
                                     <a href="{{ route('products.show', $product->id) }}" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">Lihat Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-8 text-gray-500 dark:text-gray-400">Tidak ada data produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Paginasi --}}
            <div class="p-4 border-t dark:border-gray-700">
                {{ $products->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>

@endsection
