@extends('app.layouts.app')

@section('title', 'Manajemen Produk (Admin)')

@section('content')

<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        {{-- Notifikasi Sukses atau Error --}}
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                {{ session('success') }}
            </div>
        @endif
         @if(session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            
            {{-- Header Tabel: Search dan Tombol Tambah --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form action="{{ route('products.index') }}" method="GET">
                        <label for="simple-search" class="sr-only">Cari</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                            </div>
                            <input type="text" name="search" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari produk..." value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    {{-- PERBAIKAN: Mengubah link menjadi tombol pemicu modal --}}
                    <button type="button" data-modal-target="add-product-modal" data-modal-toggle="add-product-modal" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <i class="fa-solid fa-plus h-3.5 w-3.5 mr-2"></i>
                        Tambah Produk
                    </button>
                </div>
            </div>
            
            {{-- Tabel Produk --}}
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
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button id="actions-dropdown-button-{{ $product->id }}" data-dropdown-toggle="actions-dropdown-{{ $product->id }}" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-white" type="button">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div id="actions-dropdown-{{ $product->id }}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                            <li>
                                                {{-- PERBAIKAN: Mengubah link menjadi tombol pemicu modal --}}
                                                <button type="button" data-modal-target="edit-product-modal-{{ $product->id }}" data-modal-toggle="edit-product-modal-{{ $product->id }}" class="block w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</button>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" data-modal-target="delete-modal-{{ $product->id }}" data-modal-toggle="delete-modal-{{ $product->id }}" class="block py-2 px-4 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Hapus</a>
                                        </div>
                                    </div>
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
                {!! $products->links('vendor.pagination.custom') !!}
            </div>
        </div>
    </div>
</div>

{{-- Memanggil modal tambah SATU KALI di luar loop --}}
@include('app.pages.admin.products.partials.add-modal')

{{-- Loop untuk memanggil modal edit & hapus untuk SETIAP produk --}}
@foreach ($products as $product)
    @include('app.pages.admin.products.partials.edit-modal', ['product' => $product])
    @include('app.pages.admin.products.partials.delete-modal', ['product' => $product])
@endforeach

@endsection

