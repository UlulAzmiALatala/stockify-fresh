@extends('app.layouts.app')

@section('title', 'Staff Dashboard')

@section('content')
<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Staff Dashboard</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Daftar tugas operasional gudang Anda hari ini.</p>
        </div>

        {{-- Kartu Tugas --}}
        <div class="grid grid-cols-1 gap-6 py-6 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Tugas: Konfirmasi Barang Masuk --}}
            <a href="{{ route('staff.stock.confirm-in') }}" class="block p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start justify-between">
                    <div class="w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                                Barang Masuk (Menunggu Konfirmasi)
                            </dt>
                            <dd>
                                <div class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $pendingStockIn ?? 0 }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900/50 p-3 rounded-full">
                        <i class="fa-solid fa-dolly w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
                <div class="mt-4 text-sm font-medium text-primary-600 dark:text-primary-400">
                    Lihat Tugas &rarr;
                </div>
            </a>

            {{-- Tugas: Siapkan Barang Keluar --}}
            <a href="{{ route('staff.stock.prepare-out') }}" class="block p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start justify-between">
                    <div class="w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                                Barang Keluar (Perlu Disiapkan)
                            </dt>
                            <dd>
                                <div class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $pendingStockOut ?? 0 }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="flex-shrink-0 bg-green-100 dark:bg-green-900/50 p-3 rounded-full">
                         <i class="fa-solid fa-truck-ramp-box w-6 h-6 text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
                 <div class="mt-4 text-sm font-medium text-primary-600 dark:text-primary-400">
                    Lihat Tugas &rarr;
                </div>
            </a>

        </div>
    </div>
</div>
@endsection

