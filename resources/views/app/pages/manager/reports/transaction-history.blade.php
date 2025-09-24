@extends('app.layouts.app')

@push('styles')
{{-- Memuat CSS untuk Flatpickr --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
@endpush

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="p-4 sm:p-6 xl:p-8 ">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Riwayat Transaksi Stok</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Menampilkan semua catatan barang masuk dan keluar.</p>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
        
        {{-- BAGIAN FILTER --}}
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
                <form class="flex items-center">
                    <label for="search-field" class="sr-only">Cari</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                        </div>
                        <input type="text" id="search-field" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 p-2.5" placeholder="Cari berdasarkan produk...">
                    </div>
                </form>
            </div>
            <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <select id="type-filter" class="py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-indigo-700">
                    <option selected>Semua Tipe</option>
                    <option value="in">Barang Masuk</option>
                    <option value="out">Barang Keluar</option>
                </select>
                <div class="flex items-center">
                    <input type="text" name="start" id="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Pilih Tanggal">
                </div>
            </div>
        </div>
        
        {{-- TABEL RIWAYAT TRANSAKSI --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Tanggal</th>
                        <th scope="col" class="px-4 py-3">Tipe</th>
                        <th scope="col" class="px-4 py-3">Nama Produk</th>
                        <th scope="col" class="px-4 py-3">Jumlah</th>
                        <th scope="col" class="px-4 py-3">Dicatat Oleh</th>
                        <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-3">{{ $transaction->date->format('d M Y, H:i') }}</td>
                            <td class="px-4 py-3">
                                @if($transaction->type === 'Masuk')
                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Masuk</span>
                                @else
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Keluar</span>
                                @endif
                            </td>
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $transaction->product->name ?? 'N/A' }}</th>
                            <td class="px-4 py-3 font-medium {{ $transaction->type === 'Masuk' ? 'text-green-500' : 'text-blue-500' }}">
                                {{ $transaction->type === 'Masuk' ? '+' : '-' }}{{ $transaction->quantity }}
                            </td>
                            <td class="px-4 py-3">{{ $transaction->user->name ?? 'Sistem' }}</td>
                            <td class="px-4 py-3 text-center">
                                <button data-modal-target="detail-modal-{{ $transaction->id }}" data-modal-toggle="detail-modal-{{ $transaction->id }}" type="button" class="font-medium text-indigo-600 hover:underline">Detail</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada riwayat transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="p-4">
            {{ $transactions->links() }}
        </div>
    </div>
</div>

{{-- MODAL DETAIL TRANSAKSI --}}
@foreach ($transactions as $transaction)
<div id="detail-modal-{{ $transaction->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Detail Transaksi #{{ $transaction->id }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="detail-modal-{{ $transaction->id }}">
                    <i class="fa-solid fa-times w-5 h-5"></i>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            <dl>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <dt class="font-semibold text-gray-900 dark:text-white">Produk:</dt>
                    <dd class="text-gray-500 dark:text-gray-400">{{ $transaction->product->name ?? 'N/A' }}</dd>

                    <dt class="font-semibold text-gray-900 dark:text-white">Tipe Transaksi:</dt>
                    <dd class="text-gray-500 dark:text-gray-400">{{ $transaction->type }}</dd>

                    <dt class="font-semibold text-gray-900 dark:text-white">Jumlah:</dt>
                    <dd class="font-bold {{ $transaction->type === 'Masuk' ? 'text-green-500' : 'text-blue-500' }}">{{ $transaction->quantity }} Pcs</dd>

                    <dt class="font-semibold text-gray-900 dark:text-white">Tanggal:</dt>
                    <dd class="text-gray-500 dark:text-gray-400">{{ $transaction->date->format('d F Y, H:i') }}</dd>

                    <dt class="font-semibold text-gray-900 dark:text-white">Dicatat Oleh:</dt>
                    <dd class="text-gray-500 dark:text-gray-400">{{ $transaction->user->name ?? 'Sistem' }}</dd>

                    @if($transaction->type === 'Masuk' && $transaction->supplier)
                    <dt class="font-semibold text-gray-900 dark:text-white">Dari Supplier:</dt>
                    <dd class="text-gray-500 dark:text-gray-400">{{ $transaction->supplier->name }}</dd>
                    @endif
                </div>
                <dt class="font-semibold text-gray-900 dark:text-white">Catatan:</dt>
                <dd class="text-gray-500 dark:text-gray-400">{{ $transaction->notes ?? '-' }}</dd>
            </dl>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Flatpickr pada input tanggal
        flatpickr("#start_date", {
            dateFormat: "d-m-Y",
            altInput: true,
            altFormat: "j F Y",
        });
    });
</script>
@endpush
