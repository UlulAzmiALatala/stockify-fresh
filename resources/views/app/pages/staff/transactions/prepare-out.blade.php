@extends('app.layouts.app')

@section('title', 'Siapkan Barang Keluar')

@section('content')
<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
         {{-- Notifikasi --}}
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            <div class="p-4 border-b dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Tugas: Menyiapkan Barang Keluar</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Daftar barang keluar yang perlu disiapkan untuk pengiriman.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Tanggal Dibuat</th>
                            <th scope="col" class="px-4 py-3">Produk</th>
                            <th scope="col" class="px-4 py-3">Jumlah</th>
                            <th scope="col" class="px-4 py-3">Status Awal</th>
                            <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                         @forelse ($transactions as $transaction)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                            <th class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $transaction->product->name ?? 'N/A' }}</th>
                            <td class="px-4 py-3 font-medium text-blue-500">-{{ $transaction->quantity }}</td>
                            <td class="px-4 py-3">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $transaction->status }}</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                {{-- PERBAIKAN: Tombol diubah menjadi form --}}
                                <form action="{{ route('staff.stock.prepare-out.process', $transaction->id) }}" method="POST">
                                     @csrf
                                     @method('PATCH')
                                    <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-xs px-3 py-1.5">
                                        <i class="fas fa-box-open mr-1"></i>
                                        Konfirmasi Pengeluaran
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                <i class="fas fa-check-circle text-2xl mb-2"></i>
                                <p>Tidak ada tugas pengeluaran barang saat ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="p-4 border-t dark:border-gray-700">
                {!! $transactions->links('vendor.pagination.custom') !!}
            </div>
        </div>
    </div>
</div>
@endsection

