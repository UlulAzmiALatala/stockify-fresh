@extends('app.layouts.app')

@section('title', 'Detail Produk')

@section('content')

{{-- Header Halaman dengan Breadcrumb --}}
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                    <li class="inline-flex items-center">
                        {{-- PERBAIKAN: Mengarahkan ke rute produk yang benar --}}
                        <a href="{{ route('products.index') }}" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                            <i class="fa-solid fa-box-archive w-4 h-4 mr-2"></i>
                            Produk
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Detail</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Detail Produk</h1>
        </div>
    </div>
</div>

<div class="p-4">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Kolom Gambar --}}
            <div class="lg:col-span-1">
                @if ($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-image text-4xl text-gray-400"></i>
                    </div>
                @endif
            </div>

            {{-- Kolom Detail --}}
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h2>
                <p class="text-sm font-mono text-gray-500 dark:text-gray-400 mb-4">SKU: {{ $product->sku }}</p>
                
                <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Kategori:</dt>
                        <dd class="text-gray-600 dark:text-gray-300">{{ $product->category->name ?? 'N/A' }}</dd>
                    </div>
                     <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Supplier:</dt>
                        <dd class="text-gray-600 dark:text-gray-300">{{ $product->supplier->name ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Harga Beli:</dt>
                        <dd class="text-gray-600 dark:text-gray-300">{{ 'Rp ' . number_format($product->purchase_price, 0, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Harga Jual:</dt>
                        <dd class="text-gray-600 dark:text-gray-300">{{ 'Rp ' . number_format($product->selling_price, 0, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Stok Saat Ini:</dt>
                        <dd class="text-lg font-bold {{ $product->stock <= $product->minimum_stock ? 'text-red-500' : 'text-green-500' }}">
                            {{ $product->stock }} Pcs
                        </dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-900 dark:text-white">Stok Minimum:</dt>
                        <dd class="text-gray-600 dark:text-gray-300">{{ $product->minimum_stock }} Pcs</dd>
                    </div>
                </div>

                {{-- PENAMBAHAN: Menampilkan Atribut Produk --}}
                @if($product->productAttributes->isNotEmpty())
                <div class="mt-6 border-t dark:border-gray-700 pt-4">
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Atribut Produk</h4>
                     <dl class="grid grid-cols-2 gap-4 text-sm">
                        @foreach($product->productAttributes as $attribute)
                            <div>
                                <dt class="font-semibold text-gray-900 dark:text-white">{{ $attribute->name }}:</dt>
                                <dd class="text-gray-600 dark:text-gray-300">{{ $attribute->pivot->value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
                @endif

                <div class="mt-6 border-t dark:border-gray-700 pt-4">
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Deskripsi</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300 prose dark:prose-invert max-w-none">
                        {{ $product->description ?: 'Tidak ada deskripsi.' }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end">
            {{-- PERBAIKAN: Mengarahkan kembali ke rute produk yang benar --}}
            <a href="{{ route('products.index') }}" class="text-white inline-flex items-center bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Produk
            </a>
        </div>
    </div>
</div>

@endsection

