@extends('app.layouts.app')

@section('title', 'Dashboard Utama')

@section('content')
<div class="p-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        
        {{-- Kartu Total Produk --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total Produk</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalProducts ?? '0' }}</p>
        </div>

        {{-- Kartu Stok Menipis --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Stok Menipis</h3>
            <p class="text-3xl font-bold text-red-500 mt-2">{{ $lowStockProducts ?? '0' }}</p>
        </div>

        {{-- Kartu Total Supplier --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total Supplier</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalSuppliers ?? '0' }}</p>
        </div>

        {{-- Kartu Transaksi Hari Ini (Contoh) --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Transaksi Hari Ini</h3>
            {{-- Anda bisa meminta teman back-end Anda untuk membuat variabel ini juga --}}
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $todayTransactions ?? '0' }}</p>
        </div>
    </div>

    {{-- Anda bisa menambahkan konten lain di sini, seperti grafik atau tabel ringkasan --}}

</div>
@endsection