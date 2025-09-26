@extends('app.layouts.app')

@section('title', 'Manager Dashboard')

@section('content')
<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Manager Dashboard</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Ringkasan kondisi dan aktivitas stok terkini.</p>
        </div>

        {{-- Kartu Statistik --}}
        <div class="grid grid-cols-1 gap-6 py-6 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Produk Stok Menipis --}}
            <div class="p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-100 dark:bg-yellow-900/50 p-3 rounded-full">
                        <i class="fa-solid fa-triangle-exclamation w-6 h-6 text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                                Stok Menipis
                            </dt>
                            <dd>
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $lowStockProducts ?? 0 }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Jumlah Total Produk --}}
            <div class="p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-primary-100 dark:bg-primary-900/50 p-3 rounded-full">
                        <i class="fa-solid fa-box-archive w-6 h-6 text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                                Total Jenis Produk
                            </dt>
                            <dd>
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $totalProducts ?? 0 }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Transaksi Masuk Hari Ini --}}
            <div class="p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900/50 p-3 rounded-full">
                        <i class="fa-solid fa-circle-arrow-down w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                                Barang Masuk Hari Ini
                            </dt>
                            <dd>
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $stockInToday ?? 0 }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Transaksi Keluar Hari Ini --}}
            <div class="p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 dark:bg-green-900/50 p-3 rounded-full">
                        <i class="fa-solid fa-circle-arrow-up w-6 h-6 text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                                Barang Keluar Hari Ini
                            </dt>
                            <dd>
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $stockOutToday ?? 0 }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

