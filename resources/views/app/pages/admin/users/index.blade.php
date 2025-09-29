@extends('app.layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')

<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            {{-- Header --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Manajemen Pengguna ({{ $users->total() }})</h2>
                    <form action="{{ route('users.index') }}" method="GET" class="mt-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                            </div>
                            <input type="text" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 dark:bg-gray-700" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto">
                    <button type="button" data-modal-target="add-user-modal" data-modal-toggle="add-user-modal" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-4 py-2">
                        <i class="fa-solid fa-plus h-3.5 w-3.5 mr-2"></i>
                        Tambah Pengguna
                    </button>
                </div>
            </div>
            
            {{-- Tabel Pengguna --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Pengguna</th>
                            <th scope="col" class="px-4 py-3">Email</th>
                            <th scope="col" class="px-4 py-3">Peran (Role)</th>
                            <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50">
                                <th class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $user->name }}</th>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    <span class="text-xs font-medium px-2 py-1 rounded-full bg-primary-100 text-primary-800 dark:bg-primary-900/50 dark:text-primary-300">{{ $user->getRoleNames()->first() ?? 'N/A' }}</span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                     <button type="button" data-modal-target="edit-user-modal-{{ $user->id }}" data-modal-toggle="edit-user-modal-{{ $user->id }}" class="text-yellow-400 hover:text-yellow-600 px-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" data-modal-target="delete-user-modal-{{ $user->id }}" data-modal-toggle="delete-user-modal-{{ $user->id }}" class="text-red-600 hover:text-red-800 px-2">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="p-8 text-center text-gray-500">Tidak ada data pengguna.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Paginasi --}}
            <div class="p-4 border-t dark:border-gray-700">
                {!! $users->links('vendor.pagination.custom') !!}
            </div>
        </div>
    </div>
</div>

{{-- Memanggil Modal Tambah --}}
@include('app.pages.admin.users.partials.add-modal', ['roles' => $roles])

{{-- Loop untuk Memanggil Modal Edit & Hapus --}}
@foreach ($users as $user)
    @include('app.pages.admin.users.partials.edit-modal', ['user' => $user, 'roles' => $roles])
    @include('app.pages.admin.users.partials.delete-modal', ['user' => $user])
@endforeach

@endsection
