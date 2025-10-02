@extends('app.layouts.app')

@section('title', 'Manajemen Produk (Admin)')

@section('content')

<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">{{ session('success') }}</div>
        @endif
         @if(session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">{{ session('error') }}</div>
        @endif

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            
            {{-- Header: Search, Tambah, dan Aksi --}}
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
                    <button type="button" data-modal-target="add-product-modal" data-modal-toggle="add-product-modal" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700">
                        <i class="fa-solid fa-plus h-3.5 w-3.5 mr-2"></i>
                        Tambah Produk
                    </button>
                    
                    {{-- Import & Export --}}
                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        <button type="button" data-modal-target="import-modal" data-modal-toggle="import-modal" 
                            class="flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <i class="fa-solid fa-file-import w-5 h-5 mr-2"></i>
                            Import
                        </button>

                        <a href="{{ route('products.export') }}" 
                            class="flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <i class="fa-solid fa-file-export w-5 h-5 mr-2"></i>
                            Export
                        </a>
                    </div>
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
                            <th scope="col" class="px-4 py-3">Atribut</th> {{-- Tambahan kolom --}}
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
                                <td class="px-4 py-3">
                                    @if($product->attributes && $product->attributes->count() > 0)
                                        @foreach($product->attributes as $attr)
                                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                {{ $attr->name }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 flex items-center justify-end space-x-3">
                                    <button type="button" data-modal-target="edit-product-modal-{{ $product->id }}" data-modal-toggle="edit-product-modal-{{ $product->id }}" class="text-yellow-400 hover:text-yellow-600" title="Edit">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                    </button>
                                    <button type="button" data-modal-target="delete-modal-{{ $product->id }}" data-modal-toggle="delete-modal-{{ $product->id }}" class="text-red-600 hover:text-red-800" title="Hapus">
                                        <i class="fas fa-trash w-5 h-5"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada data produk. Silakan tambahkan produk baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Paginasi --}}
            <div class="p-4 border-t dark:border-gray-700">
                {!! $products->appends(request()->query())->links('vendor.pagination.custom') !!}
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
@include('app.pages.admin.products.partials.add-modal')

@foreach ($products as $product)
    @include('app.pages.admin.products.partials.edit-modal', ['product' => $product])
    @include('app.pages.admin.products.partials.delete-modal', ['product' => $product])
@endforeach

{{-- Modal Import --}}
<div id="import-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Import Produk dari Excel</h3>
                <button type="button" class="text-gray-400" data-modal-toggle="import-modal">
                    <i class="fa-solid fa-times w-5 h-5"></i><span class="sr-only">Tutup modal</span>
                </button>
            </div>
            <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload File</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600" name="file" type="file" required>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Hanya file dengan format .xlsx atau .xls</p>
                    <a href="{{ route('products.export') }}" class="text-sm mt-2 text-primary-600 dark:text-primary-400 hover:underline">Unduh data saat ini sebagai template</a>
                </div>
                <button type="submit" class="text-white mt-4 w-full bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Import
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
