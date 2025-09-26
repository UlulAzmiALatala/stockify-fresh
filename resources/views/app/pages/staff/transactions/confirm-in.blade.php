@extends('app.layouts.app')

@section('title', 'Konfirmasi Penerimaan Barang')

@section('content')

{{-- Header Halaman --}}
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Konfirmasi Penerimaan Barang</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Verifikasi jumlah fisik barang yang diterima sesuai dengan dokumen pengiriman.</p>
        </div>
    </div>
</div>

<div class="p-4">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        
        {{-- Informasi Pengiriman --}}
        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Detail Pengiriman</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="font-semibold text-gray-600 dark:text-gray-400">ID Transaksi:</div>
                <div class="text-gray-900 dark:text-white">{{ $transaction->id ?? 'TRX-IN-00123' }}</div>
                
                <div class="font-semibold text-gray-600 dark:text-gray-400">Dari Supplier:</div>
                <div class="text-gray-900 dark:text-white">{{ $transaction->supplier->name ?? 'CV. Maju Jaya Elektronik' }}</div>

                <div class="font-semibold text-gray-600 dark:text-gray-400">Tanggal Diinput:</div>
                <div class="text-gray-900 dark:text-white">{{ $transaction->created_at->format('d F Y') ?? '25 September 2025' }}</div>
                
                <div class="font-semibold text-gray-600 dark:text-gray-400">Status Saat Ini:</div>
                <div>
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $transaction->status ?? 'Menunggu Konfirmasi' }}</span>
                </div>
            </div>
        </div>

        {{-- Form Konfirmasi --}}
        <form action="{{ route('staff.transactions.confirm-in.store', $transaction->id ?? 1) }}" method="POST">
            @csrf
            
            {{-- Tabel Produk untuk Diverifikasi --}}
            <div class="relative overflow-x-auto rounded-lg border dark:border-gray-700">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Produk</th>
                            <th scope="col" class="px-6 py-3 text-center">Jumlah Diharapkan</th>
                            <th scope="col" class="px-6 py-3 text-center">Jumlah Diterima</th>
                            <th scope="col" class="px-6 py-3 text-center">Selisih</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Data dummy, nantinya akan di-loop dari Controller --}}
                        @forelse ($transaction->products ?? [] as $product)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 verification-row">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $product->name }}
                                </th>
                                <td class="px-6 py-4 text-center expected-qty" data-expected="{{ $product->pivot->quantity }}">
                                    {{ $product->pivot->quantity }} Pcs
                                </td>
                                <td class="px-6 py-4">
                                    <input type="number" name="products[{{ $product->id }}][received_quantity]" class="received-qty bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-24 mx-auto p-2.5 text-center" placeholder="0" required>
                                </td>
                                <td class="px-6 py-4 text-center font-bold discrepancy-cell">
                                    -
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center p-4">Tidak ada produk dalam transaksi ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Catatan --}}
            <div class="mt-6">
                <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan (Jika ada kerusakan atau selisih)</label>
                <textarea id="notes" name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Contoh: 2 kardus basah, 1 produk pecah..."></textarea>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end items-center mt-6 space-x-4">
                <a href="{{ route('staff.dashboard') }}" class="text-sm font-medium text-gray-900 dark:text-white hover:underline">Kembali</a>
                 <button type="submit" class="text-white inline-flex items-center bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                     <i class="fa-solid fa-check-double mr-2"></i>
                     Konfirmasi & Selesaikan
                 </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk menghitung dan menampilkan selisih
        function calculateDiscrepancy(row) {
            const expectedQtyEl = row.querySelector('.expected-qty');
            const receivedQtyEl = row.querySelector('.received-qty');
            const discrepancyCell = row.querySelector('.discrepancy-cell');

            const expected = parseInt(expectedQtyEl.dataset.expected, 10) || 0;
            const received = parseInt(receivedQtyEl.value, 10) || 0;
            const discrepancy = received - expected;
            
            discrepancyCell.textContent = discrepancy;

            // Reset warna
            discrepancyCell.classList.remove('text-green-500', 'text-red-500');
            row.classList.remove('bg-red-50', 'dark:bg-red-900/50', 'bg-green-50', 'dark:bg-green-900/50');
            
            // Beri warna berdasarkan hasil selisih
            if (discrepancy > 0) {
                discrepancyCell.classList.add('text-green-500');
                discrepancyCell.textContent = '+' + discrepancy;
                row.classList.add('bg-green-50', 'dark:bg-green-900/50');
            } else if (discrepancy < 0) {
                discrepancyCell.classList.add('text-red-500');
                row.classList.add('bg-red-50', 'dark:bg-red-900/50');
            }
        }

        // Tambahkan event listener ke semua input jumlah
        const rows = document.querySelectorAll('.verification-row');
        rows.forEach(row => {
            const receivedInput = row.querySelector('.received-qty');
            if (receivedInput) {
                receivedInput.addEventListener('input', () => calculateDiscrepancy(row));
            }
        });
    });
</script>
@endpush
