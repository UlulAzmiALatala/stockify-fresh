@extends('app.layouts.app')

@push('styles')
{{-- Memuat CSS untuk Flatpickr (Date Picker) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
@endpush

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
    {{-- Form Filter dan Pencarian --}}
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <form action="{{ route('transactions.index') }}" method="GET">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                {{-- Pencarian --}}
                <div class="md:col-span-2">
                    <label for="search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cari Produk</label>
                    <input type="text" name="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" placeholder="Cari berdasarkan nama produk..." value="{{ request('search') }}">
                </div>
                {{-- Filter Tipe --}}
                <div>
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Transaksi</label>
                    <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700">
                        <option value="">Semua Tipe</option>
                        <option value="Masuk" {{ request('type') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="Keluar" {{ request('type') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
                    </select>
                </div>
                {{-- Filter Tanggal --}}
                <div>
                    <label for="date_range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rentang Tanggal</label>
                    <input type="text" name="date_range" id="date_range" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" placeholder="Pilih rentang tanggal" value="{{ request('date_range') }}">
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-5 py-2.5">
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Tabel Konten --}}
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">Tanggal</th>
                        <th scope="col" class="p-4">Nama Produk</th>
                        <th scope="col" class="p-4">Tipe</th>
                        <th scope="col" class="p-4">Jumlah</th>
                        <th scope="col" class="p-4">Dicatat Oleh</th>
                        <th scope="col" class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @forelse ($transactions as $transaction)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-sm font-normal text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                            <td class="p-4 text-sm font-semibold text-gray-900 dark:text-white">{{ $transaction->product->name ?? 'N/A' }}</td>
                            <td class="p-4 text-sm font-normal">
                                @if($transaction->type === 'Masuk')
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-md dark:bg-green-900 dark:text-green-300">Masuk</span>
                                @else
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-md dark:bg-blue-900 dark:text-blue-300">Keluar</span>
                                @endif
                            </td>
                            <td class="p-4 text-sm font-semibold {{ $transaction->type === 'Masuk' ? 'text-green-500' : 'text-blue-500' }}">
                                {{ $transaction->type === 'Masuk' ? '+' : '-' }} {{ $transaction->quantity }}
                            </td>
                            <td class="p-4 text-sm font-normal text-gray-500 dark:text-gray-400">{{ $transaction->user->name ?? 'Sistem' }}</td>
                            <td class="p-4 text-sm font-normal">
                                 <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $transaction->status }}</span>
                            </td>
                        </tr>
                    @empty
                         <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada riwayat transaksi yang cocok dengan filter Anda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Paginasi --}}
        <div class="p-4 border-t dark:border-gray-700">
            {!! $transactions->links('vendor.pagination.custom') !!}
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Memuat JS untuk Flatpickr --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Flatpickr pada input rentang tanggal
        flatpickr("#date_range", {
            mode: "range",
            dateFormat: "d-m-Y",
            altInput: true,
            altFormat: "j F Y",
        });
    });
</script>
@endpush
