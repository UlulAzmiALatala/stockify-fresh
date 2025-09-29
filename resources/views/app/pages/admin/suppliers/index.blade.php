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
                            <input type="text" name="search" id="supplier-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari supplier..." value="{{ request('search') }}">
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
                            <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $supplier->name }}</td>
                                <td class="px-4 py-3">{{ Str::limit($supplier->address, 40, '...') ?: '-' }}</td>
                                <td class="px-4 py-3">{{ $supplier->phone ?: '-' }}</td>
                                <td class="px-4 py-3">{{ $supplier->email ?: '-' }}</td>
                                <td class="px-4 py-3">
                                    {{-- ======================== BAGIAN AKSI YANG DISERAGAMKAN ======================== --}}
                                    <div class="flex items-center justify-center space-x-4">
                                        <!-- Edit -->
                                        <button type="button"
                                                data-modal-target="edit-supplier-modal-{{ $supplier->id }}"
                                                data-modal-toggle="edit-supplier-modal-{{ $supplier->id }}"
                                                class="text-amber-500 hover:text-amber-600"
                                                title="Edit">
                                            <!-- Heroicon Pencil Square -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M17.414 2.586a2 2 0 0 0-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 0 0 0-2.828Z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 0 1 2-2h5a1 1 0 1 1 0 2H4v10h10v-5a1 1 0 1 1 2 0v5a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <!-- Delete -->
                                        <button type="button"
                                                data-modal-target="delete-supplier-modal-{{ $supplier->id }}"
                                                data-modal-toggle="delete-supplier-modal-{{ $supplier->id }}"
                                                class="text-red-600 hover:text-red-700"
                                                title="Hapus">
                                            <!-- Heroicon Trash -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 0 0-.894.553L7.382 4H4a1 1 0 0 0 0 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a1 1 0 0 0 0-2h-3.382l-.724-1.447A1 1 0 0 0 11 2H9ZM7 8a1 1 0 0 1 2 0v6a1 1 0 1 1-2 0V8Zm5-1a1 1 0 0 0-1 1v6a1 1 0 1 0 2 0V8a1 1 0 0 0-1-1Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    {{-- ======================== AKHIR BAGIAN AKSI ======================== --}}
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
