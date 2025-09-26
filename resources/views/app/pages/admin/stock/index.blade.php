@extends('app.layouts.app')

@section('title', 'Laporan Stok Barang')

@section('content')
<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            {{-- Header Utama --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Laporan Stok Barang</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Pantau jumlah stok dan status ketersediaan semua produk.</p>
                </div>
            </div>

            {{-- Filter dan Pencarian --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-t dark:border-gray-700">
                 <form action="{{ route('admin.stock.report') }}" method="GET" class="w-full md:w-1/2">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                        </div>
                        <input type="text" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="Cari berdasarkan nama produk..." value="{{ request('search') }}">
                    </div>
                </form>
                <div class="w-full md:w-auto flex items-center space-x-3">
                     <a href="{{ route('admin.stock.report') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        Tampilkan Semua
                    </a>
                    <a href="{{ route('admin.stock.report', ['low_stock' => 1]) }}" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <i class="fa-solid fa-triangle-exclamation mr-2 text-yellow-400"></i>
                        Hanya Stok Menipis
                    </a>
                </div>
            </div>

            {{-- Tabel Data Stok --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Produk</th>
                            <th scope="col" class="px-4 py-3">Kategori</th>
                            <th scope="col" class="px-4 py-3">Stok Sistem</th>
                            <th scope="col" class="px-4 py-3">Stok Minimum</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->name }}</th>
                                <td class="px-4 py-3">{{ $product->category->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3 font-bold">{{ $product->stock }}</td>
                                <td class="px-4 py-3">{{ $product->minimum_stock }}</td>
                                <td class="px-4 py-3">
                                    @if ($product->stock == 0)
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Habis</span>
                                    @elseif ($product->stock <= $product->minimum_stock)
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Menipis</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Tersedia</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-8 text-center text-gray-500 dark:text-gray-400">Tidak ada data produk yang cocok dengan filter Anda.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginasi --}}
            <div class="p-4 border-t dark:border-gray-700">
                {!! $products->links('vendor.pagination.custom') !!}
            </div>
        </div>
    </div>
</div>
@endsection

