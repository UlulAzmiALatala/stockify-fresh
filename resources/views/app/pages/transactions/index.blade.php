@extends('app.layouts.app')

@section('title', 'Riwayat Transaksi Stok')

@section('content')

{{-- Header Halaman --}}
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Riwayat Transaksi Stok</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Lihat semua riwayat barang masuk dan keluar dari gudang.</p>
        </div>
    </div>
</div>

<div class="p-4">
    {{-- Bagian Filter dan Pencarian --}}
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label for="search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cari Produk</label>
                <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Cari berdasarkan nama produk...">
            </div>
            <div>
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Transaksi</label>
                <select id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <option selected value="">Semua Tipe</option>
                    <option value="masuk">Masuk</option>
                    <option value="keluar">Keluar</option>
                </select>
            </div>
            <div>
                <label for="date_range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rentang Tanggal</label>
                <div class="flex items-center">
                    <input type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <span class="mx-2 text-gray-500">to</span>
                    <input type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                </div>
            </div>
        </div>
    </div>

    {{-- Konten Tabel --}}
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Tanggal</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Nama Produk</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Tipe</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Jumlah</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Dicatat Oleh</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            {{-- Data Dummy Baris 1 --}}
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4 text-sm font-normal text-gray-500 dark:text-gray-400">17 Sep 2025</td>
                                <td class="p-4 text-sm font-semibold text-gray-900 dark:text-white">Laptop ProBook 14"</td>
                                <td class="p-4 text-sm font-normal">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-md dark:bg-green-900 dark:text-green-300">Masuk</span>
                                </td>
                                <td class="p-4 text-sm font-semibold text-gray-900 dark:text-white">+ 50</td>
                                <td class="p-4 text-sm font-normal text-gray-500 dark:text-gray-400">Rina Amelia</td>
                                <td class="p-4 text-sm font-normal text-gray-500 dark:text-gray-400">Diterima</td>
                            </tr>
                             {{-- Data Dummy Baris 2 --}}
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4 text-sm font-normal text-gray-500 dark:text-gray-400">18 Sep 2025</td>
                                <td class="p-4 text-sm font-semibold text-gray-900 dark:text-white">Keyboard Mechanical RGB</td>
                                <td class="p-4 text-sm font-normal">
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-md dark:bg-red-900 dark:text-red-300">Keluar</span>
                                </td>
                                <td class="p-4 text-sm font-semibold text-gray-900 dark:text-white">- 5</td>
                                <td class="p-4 text-sm font-normal text-gray-500 dark:text-gray-400">Staff Gudang A</td>
                                <td class="p-4 text-sm font-normal text-gray-500 dark:text-gray-400">Dikeluarkan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Paginasi --}}
    <div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Menampilkan <span class="font-semibold text-gray-900 dark:text-white">1-2</span> dari <span class="font-semibold text-gray-900 dark:text-white">1000</span></span>
        <ul class="inline-flex items-stretch -space-x-px">
            <li><a href="#" class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100">Previous</a></li>
            <li><a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100">1</a></li>
            <li><a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100">Next</a></li>
        </ul>
    </div>

</div>
@endsection