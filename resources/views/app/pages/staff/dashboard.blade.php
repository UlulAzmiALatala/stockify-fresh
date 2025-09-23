@extends('app.layouts.app')

@section('title', 'Dashboard Staff Gudang')

@section('content')
<div class="p-4">
    {{-- Judul Halaman --}}
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
        Tugas Hari Ini
    </h1>

    {{-- Daftar Tugas dengan Tab --}}
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg" id="incoming-tab" data-tabs-target="#incoming" type="button" role="tab" aria-controls="incoming" aria-selected="false">
                    <i class="fa-solid fa-dolly me-2"></i>Barang Masuk 
                    <span class="inline-flex items-center justify-center w-5 h-5 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                        {{ $pendingStockIn ?? '0' }}
                    </span>
                </button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="outgoing-tab" data-tabs-target="#outgoing" type="button" role="tab" aria-controls="outgoing" aria-selected="false">
                    <i class="fa-solid fa-truck-ramp-box me-2"></i>Barang Keluar
                    <span class="inline-flex items-center justify-center w-5 h-5 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                         {{ $pendingStockOut ?? '0' }}
                    </span>
                </button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        {{-- Konten Tab Barang Masuk --}}
        <div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800" id="incoming" role="tabpanel" aria-labelledby="incoming-tab">
            <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Daftar Barang Masuk Perlu Diperiksa</h3>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Produk</th>
                            <th scope="col" class="px-6 py-3">Jumlah</th>
                            <th scope="col" class="px-6 py-3">Dari Supplier</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Ulangi untuk setiap barang masuk --}}
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">Produk Contoh A</td>
                            <td class="px-6 py-4">10 Pcs</td>
                            <td class="px-6 py-4">Supplier Maju Jaya</td>
                            <td class="px-6 py-4">
                                <a href="#" class="font-medium text-green-600 dark:text-green-500 hover:underline">Konfirmasi</a>
                            </td>
                        </tr>
                        {{-- Akhir perulangan --}}
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Konten Tab Barang Keluar --}}
        <div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800" id="outgoing" role="tabpanel" aria-labelledby="outgoing-tab">
            <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Daftar Barang Keluar Perlu Disiapkan</h3>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Produk</th>
                            <th scope="col" class="px-6 py-3">Jumlah</th>
                            <th scope="col" class="px-6 py-3">Tujuan</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Ulangi untuk setiap barang keluar --}}
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">Produk Contoh B</td>
                            <td class="px-6 py-4">5 Pcs</td>
                            <td class="px-6 py-4">Cabang Jakarta</td>
                            <td class="px-6 py-4">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Siapkan</a>
                            </td>
                        </tr>
                         {{-- Akhir perulangan --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection