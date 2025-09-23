@extends('app.layouts.app')

@section('title', 'Form Barang Keluar')

@section('content')

{{-- Header Halaman --}}
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            {{-- DIPERBAIKI: Typo kecil dihapus --}}
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Form Pengeluaran Barang (Stok Keluar)</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Gunakan form ini untuk mencatat barang yang keluar dari gudang (penjualan, retur, dll.).</p>
        </div>
    </div>
</div>

<div class="p-4">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        {{-- Form --}}
        <form action="#">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div>
                    <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Produk</label>
                    <select id="product" name="product_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        {{-- DIUBAH: Teks disesuaikan --}}
                        <option selected disabled>Pilih produk yang akan dikeluarkan</option>
                        {{-- Data dummy ini nantinya akan diisi dari database --}}
                        <option value="1">Laptop ProBook 14"</option>
                        <option value="2">Keyboard Mechanical RGB</option>
                        <option value="3">Mouse Wireless Silent</option>
                    </select>
                </div>
                <div>
                    <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Keluar</label>
                    <input type="number" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Contoh: 10" required>
                </div>
                <div>
                    {{-- DIUBAH: Label dan input diganti dari <select> menjadi <input type="text"> --}}
                    <label for="destination" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tujuan Pengeluaran</label>
                    <input type="text" name="destination" id="destination" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Contoh: Penjualan #12345" required>
                </div>
                <div>
                    {{-- DIPERBAIKI: Tag </gudang> dihapus --}}
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal keluar</label>
                    <input type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>
                <div class="lg:col-span-2">
                    <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan (Opsional)</label>
                    <textarea id="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" placeholder="Contoh: Retur ke supplier PT. Sejahtera Abadi"></textarea>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                 {{-- DIUBAH: Teks tombol disesuaikan --}}
                 <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                     Catat Pengeluaran
                </button>
            </div>
        </form>
    </div>
</div>

@endsection