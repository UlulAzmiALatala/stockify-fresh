@extends('app.layouts.app')

@section('title', 'Manajemen Atribut')

@section('content')

<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        {{-- Notifikasi --}}
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
            {{-- Header Kartu --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b dark:border-gray-700">
                <div class="w-full">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Daftar Atribut Produk
                        <span class="text-gray-500">({{ $attributes->total() }})</span>
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

            {{-- Tabel Konten --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Atribut</th>
                            <th scope="col" class="px-4 py-3">Tipe Input</th>
                            <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attributes as $attribute)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-4 py-3 font-semibold text-gray-900 dark:text-white">{{ $attribute->name }}</td>
                            <td class="px-4 py-3">
                                @if($attribute->type == 'select')
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Pilihan</span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Teks</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    <button type="button" data-modal-target="edit-attribute-modal-{{ $attribute->id }}" data-modal-toggle="edit-attribute-modal-{{ $attribute->id }}" class="text-yellow-400 hover:text-yellow-600" title="Edit">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                    </button>
                                    <button type="button" data-modal-target="delete-attribute-modal-{{ $attribute->id }}" data-modal-toggle="delete-attribute-modal-{{ $attribute->id }}" class="text-red-600 hover:text-red-800" title="Hapus">
                                        <i class="fas fa-trash w-5 h-5"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-8 px-4 text-center text-gray-500 dark:text-gray-400">
                                <h5 class="mb-2 text-xl font-bold">Tidak Ada Atribut</h5>
                                <p>Mulai dengan menambahkan atribut produk pertama Anda.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             {{-- Paginasi --}}
            <div class="p-4 border-t dark:border-gray-700">
                {!! $attributes->appends(request()->query())->links('vendor.pagination.custom') !!}
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

