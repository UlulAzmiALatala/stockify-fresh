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
                                {{-- PERBAIKAN: Tombol ini sekarang memicu modal --}}
                                <button type="button" data-modal-target="prepare-out-modal-{{ $transaction->id }}" data-modal-toggle="prepare-out-modal-{{ $transaction->id }}" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-xs px-3 py-1.5">
                                    <i class="fas fa-box-open mr-1"></i>
                                    Konfirmasi Pengeluaran
                                </button>
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

{{-- PERBAIKAN: Modal konfirmasi ditambahkan di sini --}}
@foreach($transactions as $transaction)
<div id="prepare-out-modal-{{ $transaction->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="prepare-out-modal-{{ $transaction->id }}">
                <i class="fa-solid fa-times w-5 h-5"></i><span class="sr-only">Tutup modal</span>
            </button>
            <i class="fa-solid fa-question-circle text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto"></i>
            <p class="mb-4 text-gray-500 dark:text-gray-300">Anda yakin ingin mengonfirmasi pengeluaran <strong>{{ $transaction->quantity }} pcs {{ $transaction->product->name }}</strong>?</p>
            <div class="flex justify-center items-center space-x-4">
                <button data-modal-toggle="prepare-out-modal-{{ $transaction->id }}" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">
                    Tidak, batalkan
                </button>
                <form action="{{ route('staff.stock.prepare-out.process', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Ya, saya yakin
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

