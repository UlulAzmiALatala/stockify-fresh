@extends('app.layouts.app')

@section('title', 'Detail Supplier')

@section('content')

{{-- Header Halaman dengan Breadcrumb --}}
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                  <li class="inline-flex items-center">
                    <a href="{{ route('suppliers.index') }}" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                      <i class="fa-solid fa-truck-fast w-4 h-4 mr-2"></i>
                      Supplier
                    </a>
                  </li>
                  <li>
                    <div class="flex items-center">
                      <i class="fa-solid fa-chevron-right w-6 h-6 text-gray-400"></i>
                      <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Detail</span>
                    </div>
                  </li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Detail Supplier</h1>
        </div>
    </div>
</div>

<div class="p-4">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        {{-- Informasi Utama Supplier --}}
        <div class="mb-6 border-b dark:border-gray-700 pb-6">
             <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $supplier->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <dt class="font-semibold text-gray-900 dark:text-white">Email:</dt>
                    <dd class="text-gray-600 dark:text-gray-300">{{ $supplier->email ?: 'Tidak ada' }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-900 dark:text-white">Telepon:</dt>
                    <dd class="text-gray-600 dark:text-gray-300">{{ $supplier->phone ?: 'Tidak ada' }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-900 dark:text-white">Alamat:</dt>
                    <dd class="text-gray-600 dark:text-gray-300">{{ $supplier->address ?: 'Tidak ada' }}</dd>
                </div>
            </div>
        </div>

        {{-- Daftar Produk dari Supplier Ini --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Produk dari Supplier Ini ({{ $supplier->products->count() }})</h3>
            <div class="divide-y dark:divide-gray-700">
                @forelse ($supplier->products as $product)
                    <div class="py-3 flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $product->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SKU: {{ $product->sku }}</p>
                        </div>
                        <a href="{{ route('products.show', $product->id) }}" class="text-xs font-medium text-primary-600 hover:underline">Lihat Detail Produk &rarr;</a>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">Supplier ini belum memiliki produk yang terdaftar.</p>
                @endforelse
            </div>
        </div>

         <div class="mt-6 flex justify-end">
            <a href="{{ route('suppliers.index') }}" class="text-white inline-flex items-center bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Supplier
            </a>
        </div>
    </div>
</div>

@endsection
