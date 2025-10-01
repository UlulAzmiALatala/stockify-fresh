@extends('app.layouts.app')

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
                                <div class="flex items-center justify-center space-x-3">
                                    {{-- Tombol Edit (Outline Pensil Kuning/Jingga) --}}
                                    <button type="button"
                                            data-modal-target="edit-attribute-modal-{{ $attribute->id }}"
                                            data-modal-toggle="edit-attribute-modal-{{ $attribute->id }}"
                                            class="text-orange-400 hover:text-orange-500 dark:text-orange-300 dark:hover:text-orange-400"
                                            title="Edit">
                                        {{-- Icon Heroicon Pencil (Outline) --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>

                                    {{-- KODE SVG TRASH YANG SUDAH DIPERBAIKI --}}
                                    <button type="button"
                                            data-modal-target="delete-attribute-modal-{{ $attribute->id }}"
                                            data-modal-toggle="delete-attribute-modal-{{ $attribute->id }}"
                                            class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-400"
                                            title="Hapus">
                                        {{-- Icon Heroicon Trash (Outline) --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-8 px-4 text-center">
                                <svg class="mx-auto mb-4 w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 4V2a1 1 0 0 1 1-1h8a1 1 0 011 1v2M5 8h14M5 11h14M5 14h14M5 17h14M5 20h14" />
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