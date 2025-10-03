@extends('app.layouts.app')

@section('title', 'Daftar Supplier')

@section('content')

<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            
            {{-- Header Tabel --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Daftar Supplier</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Menampilkan semua supplier yang terdaftar di sistem.</p>
                </div>
                <div class="w-full md:w-1/2">
                    <form action="{{ route('suppliers.index') }}" method="GET" class="flex items-center">
                        <label for="supplier-search" class="sr-only">Cari</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                            </div>
                            <input type="text" name="search" id="supplier-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 dark:bg-gray-700" placeholder="Cari supplier..." value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- Tabel Supplier --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Supplier</th>
                            <th scope="col" class="px-4 py-3">Telepon</th>
                            <th scope="col" class="px-4 py-3">Email</th>
                            <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $supplier->name }}</td>
                                <td class="px-4 py-3">{{ $supplier->phone ?: '-' }}</td>
                                <td class="px-4 py-3">{{ $supplier->email ?: '-' }}</td>
                                {{-- PERBAIKAN: Menambahkan tombol lihat detail --}}
                                <td class="px-4 py-3 text-right">
                                     <a href="{{ route('suppliers.show', $supplier->id) }}" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">Lihat Detail</a>
                                </td>
                            </tr>
                        @empty
                             <tr>
                                <td colspan="4" class="text-center p-8 text-gray-500 dark:text-gray-400">
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

@endsection

