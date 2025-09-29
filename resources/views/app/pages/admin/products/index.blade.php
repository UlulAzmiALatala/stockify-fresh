@extends('app.layouts.app')

@section('title', 'Manajemen Produk (Admin)')

@section('content')
<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">

        {{-- Notifikasi --}}
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

            {{-- Header: Search + Tambah --}}
            <div class="flex flex-col md:flex-row items-center justify-between p-4 space-y-3 md:space-y-0 md:space-x-4">
                <div class="w-full md:w-1/2">
                    <form action="{{ route('products.index') }}" method="GET">
                        <label for="simple-search" class="sr-only">Cari</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <!-- Heroicon Search -->
                                <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Cari produk..." value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex items-center justify-end">
                    <!-- Tombol Tambah Produk -->
                    <button type="button" data-modal-target="add-product-modal" data-modal-toggle="add-product-modal"
                        class="flex items-center text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none">
                        <!-- Heroicon Plus -->
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Produk
                    </button>
                </div>
            </div>

            {{-- Tabel Produk --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-3">Nama Produk</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Harga Jual</th>
                            <th class="px-4 py-3">Stok</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                            <td class="px-4 py-3">{{ $product->category->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ 'Rp ' . number_format($product->selling_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $product->stock }}</td>
                            <td class="px-4 py-3 flex items-center justify-end space-x-3">
                                <!-- Edit -->
                                <button type="button"
                                    data-modal-target="edit-product-modal-{{ $product->id }}"
                                    data-modal-toggle="edit-product-modal-{{ $product->id }}"
                                    class="text-amber-500 hover:text-amber-600"
                                    title="Edit">
                                    <!-- Heroicon Pencil Square -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path d="M17.414 2.586a2 2 0 0 0-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 0 0 0-2.828Z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 0 1 2-2h5a1 1 0 1 1 0 2H4v10h10v-5a1 1 0 1 1 2 0v5a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <!-- Delete -->
                                <button type="button"
                                    data-modal-target="delete-modal-{{ $product->id }}"
                                    data-modal-toggle="delete-modal-{{ $product->id }}"
                                    class="text-red-600 hover:text-red-700"
                                    title="Hapus">
                                    <!-- Heroicon Trash -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 0 0-.894.553L7.382 4H4a1 1 0 0 0 0 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a1 1 0 0 0 0-2h-3.382l-.724-1.447A1 1 0 0 0 11 2H9ZM7 8a1 1 0 0 1 2 0v6a1 1 0 1 1-2 0V8Zm5-1a1 1 0 0 0-1 1v6a1 1 0 1 0 2 0V8a1 1 0 0 0-1-1Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
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

{{-- Modal tambah --}}
@include('app.pages.admin.products.partials.add-modal')

{{-- Modal edit & hapus per produk --}}
@foreach ($products as $product)
    @include('app.pages.admin.products.partials.edit-modal', ['product' => $product])
    @include('app.pages.admin.products.partials.delete-modal', ['product' => $product])
@endforeach
@endsection
