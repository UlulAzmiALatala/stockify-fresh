{{-- Memberitahu Blade untuk menggunakan kerangka utama dari folder layouts --}}
@extends('app.layouts.app')

{{-- Mengatur judul spesifik untuk halaman ini --}}
@section('title', 'Manajemen Kategori')

{{-- Ini adalah bagian konten yang akan dimasukkan ke @yield('content') di layout utama --}}
@section('content')

<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
        {{-- Menampilkan notifikasi sukses atau error di bagian atas --}}
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
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">

            {{-- Header Kartu: Judul, Cari, dan Tombol Tambah --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b dark:border-gray-700">
                <div class="w-full md:w-1/2">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Daftar Kategori
                        <span class="text-gray-500">({{ $categories->total() }})</span>
                    </h5>
                </div>
                <div class="w-full md:w-1/2 flex justify-end items-center space-x-3">
                    <form action="{{ route('categories.index') }}" method="GET" class="w-full max-w-sm">
                        <label for="search" class="sr-only">Cari</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cari kategori" value="{{ request('search') }}">
                        </div>
                    </form>
                    <button type="button" data-modal-target="add-category-modal" data-modal-toggle="add-category-modal" class="flex-shrink-0 flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah Kategori
                    </button>
                </div>
            </div>

            {{-- Konten Tabel --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">No</th>
                            <th scope="col" class="px-4 py-3">Nama Kategori</th>
                            <th scope="col" class="px-4 py-3">Deskripsi</th>
                            <th scope="col" class="px-4 py-3">Jumlah Produk</th>
                            <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</th>
                                <td class="px-4 py-3 font-semibold">{{ $category->name }}</td>
                                <td class="px-4 py-3">{{ Str::limit($category->description, 50, '...') ?: '-' }}</td>
                                <td class="px-4 py-3">{{ $category->products_count }}</td>
                                <td class="px-4 py-3">
                                    {{-- ======================== BAGIAN AKSI YANG DISERAGAMKAN ======================== --}}
                                    <div class="flex items-center justify-center space-x-4">
                                        {{-- Tombol Edit --}}
                                        <button type="button"
                                                data-modal-target="edit-category-modal-{{ $category->id }}"
                                                data-modal-toggle="edit-category-modal-{{ $category->id }}"
                                                class="text-amber-500 hover:text-amber-600"
                                                title="Edit">
                                            <!-- Heroicon Pencil Square -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M17.414 2.586a2 2 0 0 0-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 0 0 0-2.828Z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 0 1 2-2h5a1 1 0 1 1 0 2H4v10h10v-5a1 1 0 1 1 2 0v5a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        {{-- Tombol Hapus --}}
                                        <button type="button"
                                                data-modal-target="delete-category-modal-{{ $category->id }}"
                                                data-modal-toggle="delete-category-modal-{{ $category->id }}"
                                                class="text-red-600 hover:text-red-700"
                                                title="Hapus">
                                            <!-- Heroicon Trash -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 0 0-.894.553L7.382 4H4a1 1 0 0 0 0 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a1 1 0 0 0 0-2h-3.382l-.724-1.447A1 1 0 0 0 11 2H9ZM7 8a1 1 0 0 1 2 0v6a1 1 0 1 1-2 0V8Zm5-1a1 1 0 0 0-1 1v6a1 1 0 1 0 2 0V8a1 1 0 0 0-1-1Z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    {{-- ======================== AKHIR BAGIAN AKSI ======================== --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 px-4 text-center">
                                    <svg class="mx-auto mb-4 w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M7 4V2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v2M5 8h14M5 11h14M5 14h14M5 17h14M5 20h14" />
                                    </svg>
                                    <h5 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Tidak Ada Kategori Ditemukan</h5>
                                    <p class="font-normal text-gray-500">Mulai dengan menambahkan kategori produk pertama Anda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginasi --}}
            <div class="p-4 border-t dark:border-gray-700">
                {!! $categories->appends(request()->query())->links() !!}
            </div>
        </div>
    </div>
</section>

{{-- Memanggil partial untuk modal tambah --}}
@include('app.pages.admin.categories.partials.add-modal')

{{-- Loop untuk memanggil modal edit & hapus (agar modalnya ada di HTML) --}}
@if($categories->count() > 0)
    @foreach ($categories as $category)
        @include('app.pages.admin.categories.partials.edit-modal', ['category' => $category])
        @include('app.pages.admin.categories.partials.delete-modal', ['category' => $category])
    @endforeach
@endif

@endsection

