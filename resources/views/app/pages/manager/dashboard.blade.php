@extends('app.layouts.app')

@section('title', 'Dashboard Manajer Gudang')

@section('content')
<div class="p-4">
    {{-- Judul Halaman --}}
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
        Ringkasan Gudang
    </h1>

    {{-- Kartu Ringkasan (Grid diubah menjadi 3 kolom untuk layar besar) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        
        {{-- Kartu Stok Menipis --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400">Stok Menipis</h3>
                <i class="fa-solid fa-triangle-exclamation text-2xl text-red-500"></i>
            </div>
            <p class="text-3xl font-bold text-red-500 mt-2">{{ $lowStockProducts ?? '0' }}</p>
            <a href="#" class="text-sm font-medium text-indigo-600 hover:underline dark:text-indigo-500 mt-1">Lihat Detail</a>
        </div>

        {{-- Kartu Barang Masuk Hari Ini --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400">Barang Masuk Hari Ini</h3>
                <i class="fa-solid fa-arrow-down-to-bracket text-2xl text-green-500"></i>
            </div>
            <p class="text-3xl font-bold text-green-500 mt-2">{{ $stockInToday ?? '0' }}</p>
            <a href="{{ route('manager.transactions.stockin') }}" class="text-sm font-medium text-indigo-600 hover:underline dark:text-indigo-500 mt-1">Catat Barang Masuk</a>
        </div>

        {{-- Kartu Barang Keluar Hari Ini --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400">Barang Keluar Hari Ini</h3>
                <i class="fa-solid fa-arrow-up-from-bracket text-2xl text-blue-500"></i>
            </div>
            <p class="text-3xl font-bold text-blue-500 mt-2">{{ $stockOutToday ?? '0' }}</p>
            <a href="{{ route('manager.transactions.stockout') }}" class="text-sm font-medium text-indigo-600 hover:underline dark:text-indigo-500 mt-1">Catat Barang Keluar</a>
        </div>
    </div>

    {{-- Konten Tambahan --}}
    <div class="mt-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Aktivitas Terkini</h2>
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            {{-- Di sini Anda bisa menambahkan tabel yang menampilkan daftar barang yang stoknya menipis --}}
            {{-- atau riwayat transaksi terakhir. --}}
            <p class="text-gray-500 dark:text-gray-400">Tabel aktivitas atau daftar produk akan ditampilkan di sini.</p>
        </div>
    </div>

</div>
@endsection