@extends('app.layouts.app')

@push('styles')
{{-- Memuat CSS untuk Flatpickr (Date Picker) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
@endpush

@section('title', 'Form Barang Masuk')

@section('content')

{{-- Header Halaman --}}
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Form Penerimaan Barang (Stok Masuk)</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Gunakan form ini untuk mencatat barang yang masuk ke gudang.</p>
        </div>
    </div>
</div>

<div class="p-4">
    {{-- Menampilkan notifikasi sukses atau error --}}
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">Sukses!</span> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Gagal!</span> {{ session('error') }}
        </div>
    @endif

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        {{-- Form --}}
        <form action="{{ route('stock.in.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div>
                    <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Produk</label>
                    <select id="product" name="product_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        <option value="" selected disabled>Pilih produk yang diterima</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} (Stok saat ini: {{ $product->stock }})
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Masuk</label>
                    <input type="number" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Contoh: 100" value="{{ old('quantity') }}" required>
                    @error('quantity')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Diterima</label>
                    <input type="text" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Pilih tanggal" value="{{ old('date', now()->format('d-m-Y')) }}" required>
                    @error('date')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diterima Dari Supplier (Opsional)</label>
                    <select id="supplier" name="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="">Tidak ada supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="lg:col-span-2">
                    <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan (Opsional)</label>
                    <textarea id="notes" name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Contoh: Kondisi kardus sedikit basah.">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end mt-6">
                 <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
{{-- Memuat JS untuk Flatpickr --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Flatpickr pada input tanggal
        flatpickr("#date", {
            dateFormat: "d-m-Y", // Format yang dikirim ke server
            altInput: true,
            altFormat: "j F Y", // Format yang dilihat pengguna
        });
    });
</script>
@endpush
