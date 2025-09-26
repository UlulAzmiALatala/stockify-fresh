@extends('app.layouts.app')

@section('title', 'Stock Opname')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Stock Opname</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Gunakan form ini untuk menyesuaikan stok sistem dengan stok fisik di gudang.</p>
    </div>
</div>

<div class="p-4">
    {{-- Notifikasi Sukses atau Error --}}
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">{{ session('error') }}</div>
    @endif

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <form action="{{ route('manager.stock.opname.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div>
                    <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Produk</label>
                    <select name="product_id" id="product_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" required>
                        <option value="" disabled selected>Pilih produk untuk disesuaikan</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} (Stok Sistem: {{ $product->stock }})
                            </option>
                        @endforeach
                    </select>
                    @error('product_id') <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="physical_stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Stok Fisik</label>
                    <input type="number" name="physical_stock" id="physical_stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="Masukkan jumlah hitungan fisik" value="{{ old('physical_stock') }}" required>
                     @error('physical_stock') <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="lg:col-span-2">
                    <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alasan Penyesuaian</label>
                    <textarea name="notes" id="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600" placeholder="Contoh: Hasil perhitungan stok bulanan" required>{{ old('notes') }}</textarea>
                    @error('notes') <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="flex justify-end mt-6">
                 <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                    <i class="fas fa-check-double mr-2"></i>
                    Buat Penyesuaian Stok
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

