@extends('app.layouts.app') 

@section('title', 'Laporan Aplikasi')

@section('content')
<div class="p-4 sm:p-6 xl:p-8 ">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
        Pusat Laporan
    </h1>

    {{-- BAGIAN FILTER --}}
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="font-semibold text-lg mb-3 dark:text-white">Filter Laporan</h3>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            {{-- Filter Rentang Tanggal --}}
            <div date-rangepicker class="flex items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fa-solid fa-calendar-week text-gray-500 dark:text-gray-400"></i>
                    </div>
                    <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700" placeholder="Tanggal Mulai">
                </div>
                <span class="mx-4 text-gray-500">to</span>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                         <i class="fa-solid fa-calendar-week text-gray-500 dark:text-gray-400"></i>
                    </div>
                    <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700" placeholder="Tanggal Akhir">
                </div>
            </div>
            
            {{-- Filter Kategori --}}
            <div>
                <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
                    <option selected>Semua Kategori</option>
                    {{-- Loop data kategori dari database --}}
                    <option value="1">Elektronik</option>
                    <option value="2">Pakaian</option>
                </select>
            </div>

            {{-- Filter Pengguna --}}
            <div>
                 <select id="user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
                    <option selected>Semua Pengguna</option>
                    {{-- Loop data pengguna dari database --}}
                    <option value="1">Admin</option>
                    <option value="2">Manager Gudang</option>
                </select>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-end space-x-2">
                 <button type="button" class="w-full px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg">Tampilkan</button>
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
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="stock-tab" data-tabs-target="#stock" type="button" role="tab" aria-controls="stock" aria-selected="false">Laporan Stok</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="transaction-tab" data-tabs-target="#transaction" type="button" role="tab" aria-controls="transaction" aria-selected="false">Laporan Transaksi</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="activity-tab" data-tabs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="false">Laporan Aktivitas</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        {{-- KONTEN TAB 1: LAPORAN STOK --}}
        <div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800" id="stock" role="tabpanel" aria-labelledby="stock-tab">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    {{-- Tabel Laporan Stok seperti di jawaban sebelumnya --}}
                </table>
            </div>
        </div>
        {{-- KONTEN TAB 2: LAPORAN TRANSAKSI --}}
        <div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">
             <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    {{-- Tabel Laporan Transaksi seperti di jawaban sebelumnya --}}
                </table>
            </div>
        </div>
        {{-- KONTEN TAB 3: LAPORAN AKTIVITAS PENGGUNA --}}
        <div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800" id="activity" role="tabpanel" aria-labelledby="activity-tab">
            <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Log Aktivitas Pengguna</h3>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Waktu</th>
                            <th scope="col" class="px-6 py-3">Pengguna</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                            <th scope="col" class="px-6 py-3">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Ulangi untuk setiap data log aktivitas --}}
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">2025-09-23 08:30:15</td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Admin Stockify</td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">CREATE</span>
                            </td>
                            <td class="px-6 py-4">Menambahkan produk baru: 'Laptop ProBook 14"'</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">2025-09-23 08:32:40</td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Manager Gudang</td>
                            <td class="px-6 py-4">
                               <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">STOCK IN</span>
                            </td>
                            <td class="px-6 py-4">Menerima 10 Pcs 'Laptop ProBook 14"' dari supplier 'CV. Maju Jaya'</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">2025-09-23 08:35:00</td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Admin Stockify</td>
                            <td class="px-6 py-4">
                               <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">DELETE</span>
                            </td>
                            <td class="px-6 py-4">Menghapus kategori: 'Aksesoris'</td>
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
@endpush