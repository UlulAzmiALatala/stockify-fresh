@extends('app.layouts.app')

@section('title', 'Laporan Stok dan Transaksi')

@section('content')
<div class="p-4">
    {{-- Judul Halaman --}}
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
        Laporan Stok dan Transaksi
    </h1>

    {{-- BAGIAN FILTER --}}
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            {{-- Filter Rentang Tanggal --}}
            <div date-rangepicker class="flex items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fa-solid fa-calendar-week text-gray-500 dark:text-gray-400"></i>
                    </div>
                    <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal Mulai">
                </div>
                <span class="mx-4 text-gray-500">to</span>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                         <i class="fa-solid fa-calendar-week text-gray-500 dark:text-gray-400"></i>
                    </div>
                    <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal Akhir">
                </div>
            </div>
            
            {{-- Filter Kategori --}}
            <div>
                <label for="category" class="sr-only">Pilih Kategori</label>
                <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Semua Kategori</option>
                    {{-- Loop data kategori dari database --}}
                    <option value="1">Elektronik</option>
                    <option value="2">Pakaian</option>
                    <option value="3">Makanan</option>
                </select>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-end space-x-2">
                 <button type="button" class="w-full px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg">Tampilkan</button>
                 <button type="button" class="px-3 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <i class="fa-solid fa-print"></i>
                 </button>
                 <button type="button" class="px-3 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <i class="fa-solid fa-file-export"></i>
                 </button>
            </div>
        </div>
    </div>

    {{-- BAGIAN TAB --}}
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="stock-report-tab" data-tabs-target="#stock-report" type="button" role="tab" aria-controls="stock-report" aria-selected="false">Laporan Stok Barang</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="transaction-report-tab" data-tabs-target="#transaction-report" type="button" role="tab" aria-controls="transaction-report" aria-selected="false">Laporan Transaksi</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        {{-- KONTEN TAB 1: LAPORAN STOK BARANG --}}
        <div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800" id="stock-report" role="tabpanel" aria-labelledby="stock-report-tab">
            <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Detail Stok Barang</h3>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Produk</th>
                            <th scope="col" class="px-6 py-3">Kategori</th>
                            <th scope="col" class="px-6 py-3">Stok Awal</th>
                            <th scope="col" class="px-6 py-3">Masuk</th>
                            <th scope="col" class="px-6 py-3">Keluar</th>
                            <th scope="col" class="px-6 py-3">Stok Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Ulangi untuk setiap data laporan stok --}}
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Laptop Pro 15"</td>
                            <td class="px-6 py-4">Elektronik</td>
                            <td class="px-6 py-4">20</td>
                            <td class="px-6 py-4 text-green-500">+10</td>
                            <td class="px-6 py-4 text-red-500">-5</td>
                            <td class="px-6 py-4 font-bold">25</td>
                        </tr>
                        {{-- Akhir perulangan --}}
                    </tbody>
                </table>
            </div>
        </div>
        {{-- KONTEN TAB 2: LAPORAN TRANSAKSI --}}
        <div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800" id="transaction-report" role="tabpanel" aria-labelledby="transaction-report-tab">
             <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Detail Barang Masuk & Keluar</h3>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3">Tipe</th>
                            <th scope="col" class="px-6 py-3">Nama Produk</th>
                            <th scope="col" class="px-6 py-3">Jumlah</th>
                            <th scope="col" class="px-6 py-3">Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Ulangi untuk setiap data transaksi --}}
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">23 Sep 2025, 10:00</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Masuk</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Laptop Pro 15"</td>
                            <td class="px-6 py-4">+10</td>
                            <td class="px-6 py-4">Manager Gudang</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">23 Sep 2025, 14:30</td>
                            <td class="px-6 py-4">
                               <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Keluar</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Laptop Pro 15"</td>
                            <td class="px-6 py-4">-5</td>
                            <td class="px-6 py-4">Staff Gudang</td>
                        </tr>
                        {{-- Akhir perulangan --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Pastikan Anda sudah memuat Flowbite dan dependency-nya (seperti Datepicker) --}}
{{-- Biasanya ini sudah ada di file app.js utama Anda jika menggunakan Vite --}}
@endpush