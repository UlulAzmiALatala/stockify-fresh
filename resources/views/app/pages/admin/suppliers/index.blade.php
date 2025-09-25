@extends('app.layouts.app')

@section('title', 'Manajemen Supplier')

@section('content')

{{-- Bagian Konten Utama --}}
<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        {{-- Notifikasi Sukses atau Error --}}
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

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            
            {{-- Header Tabel (Judul, Search, Tombol Tambah) --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Daftar Supplier ({{ $suppliers->total() }})</h2>
                     <form action="{{ route('suppliers.index') }}" method="GET" class="mt-2">
                        <label for="supplier-search" class="sr-only">Cari</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                            </div>
                            <input type="text" name="search" id="supplier-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="Cari supplier..." value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" data-modal-target="add-supplier-modal" data-modal-toggle="add-supplier-modal" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700">
                        <i class="fa-solid fa-plus h-3.5 w-3.5 mr-2"></i>
                        Tambah Supplier
                    </button>
                </div>
            </div>
            
            {{-- Tabel Supplier --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Supplier</th>
                            <th scope="col" class="px-4 py-3">Alamat</th>
                            <th scope="col" class="px-4 py-3">Telepon</th>
                            <th scope="col" class="px-4 py-3">Email</th>
                            <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $supplier->name }}</td>
                                <td class="px-4 py-3">{{ Str::limit($supplier->address, 40, '...') ?: '-' }}</td>
                                <td class="px-4 py-3">{{ $supplier->phone ?: '-' }}</td>
                                <td class="px-4 py-3">{{ $supplier->email ?: '-' }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button type="button" data-modal-target="edit-supplier-modal-{{ $supplier->id }}" data-modal-toggle="edit-supplier-modal-{{ $supplier->id }}" class="text-yellow-400 hover:text-yellow-600 px-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" data-modal-target="delete-supplier-modal-{{ $supplier->id }}" data-modal-toggle="delete-supplier-modal-{{ $supplier->id }}" class="text-red-600 hover:text-red-800 px-2">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                             <tr>
                                <td colspan="5" class="text-center p-8 text-gray-500 dark:text-gray-400">
                                    Tidak ada data supplier.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Paginasi --}}
            <div class="p-4 border-t dark:border-gray-700">
                {!! $suppliers->links('vendor.pagination.custom') !!}
            </div>
        </div>
    </div>
</div>

{{-- Memanggil Modal Tambah --}}
@include('app.pages.admin.suppliers.partials.add-modal')

{{-- Loop untuk Memanggil Modal Edit & Hapus --}}
@foreach ($suppliers as $supplier)
    @include('app.pages.admin.suppliers.partials.edit-modal', ['supplier' => $supplier])
    @include('app.pages.admin.suppliers.partials.delete-modal', ['supplier' => $supplier])
@endforeach

@endsection
