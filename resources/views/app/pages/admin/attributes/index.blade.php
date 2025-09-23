{{-- Memberitahu Blade untuk menggunakan kerangka utama dari folder layouts --}}
@extends('app.layouts.app')

{{-- Mengatur judul spesifik untuk halaman ini --}}
@section('title', 'Manajemen Atribut')

{{-- Ini adalah bagian konten yang akan dimasukkan ke @yield('content') di layout utama --}}
@section('content')

<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
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

        {{-- Komponen Kartu Utama --}}
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            {{-- Header Kartu: Judul dan Tombol Tambah --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b dark:border-gray-700">
                <div class="w-full md:w-1/2">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Daftar Atribut
                        <span class="text-gray-500">({{ $attributes->count() }})</span>
                    </h5>
                </div>
                <div class="w-full md:w-1/2 flex justify-end items-center space-x-3">
                    <button type="button" data-modal-target="add-attribute-modal" data-modal-toggle="add-attribute-modal" class="flex-shrink-0 flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah Atribut
                    </button>
                </div>
            </div>

            {{-- Konten Tabel --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">ID</th>
                            <th scope="col" class="px-4 py-3">Nama Atribut</th>
                            <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attributes as $attribute)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $attribute->id }}</td>
                            <td class="px-4 py-3 font-semibold">{{ $attribute->name }}</td>
                            <td class="px-4 py-3 text-center">
                                {{-- Tombol Aksi Dropdown --}}
                                <button id="attribute-options-{{ $attribute->id }}" data-dropdown-toggle="dropdown-{{ $attribute->id }}" class="inline-flex items-center text-gray-500 hover:text-gray-800 dark:hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-100 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div id="dropdown-{{ $attribute->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="attribute-options-{{ $attribute->id }}">
                                        <li>
                                            <button data-modal-target="edit-attribute-modal-{{ $attribute->id }}" data-modal-toggle="edit-attribute-modal-{{ $attribute->id }}" class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                <i class="fas fa-edit mr-2"></i>Edit
                                            </button>
                                        </li>
                                        <li>
                                            <button data-modal-target="delete-attribute-modal-{{ $attribute->id }}" data-modal-toggle="delete-attribute-modal-{{ $attribute->id }}" class="w-full text-left block px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-500 dark:hover:text-white">
                                                <i class="fas fa-trash mr-2"></i>Hapus
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-8 px-4 text-center">
                                <svg class="mx-auto mb-4 w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 4V2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v2M5 8h14M5 11h14M5 14h14M5 17h14M5 20h14" />
                                </svg>
                                <h5 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Tidak Ada Atribut Ditemukan</h5>
                                <p class="font-normal text-gray-500">Mulai dengan menambahkan atribut produk pertama Anda.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- Memanggil partial untuk modal tambah --}}
@include('app.pages.admin.attributes.partials.add-modal')

{{-- Loop untuk memanggil modal edit & hapus --}}
@if($attributes->count() > 0)
    @foreach ($attributes as $attribute)
        @include('app.pages.admin.attributes.partials.edit-modal', ['attribute' => $attribute])
        @include('app.pages.admin.attributes.partials.delete-modal', ['attribute' => $attribute])
    @endforeach
@endif

@endsection