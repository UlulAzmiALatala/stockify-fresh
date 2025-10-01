@extends('app.layouts.app')

@section('title', 'Laporan Aktivitas Pengguna')

@section('content')
<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            {{-- Header --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Laporan Aktivitas Pengguna</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Melacak semua perubahan dan aktivitas penting dalam sistem.</p>
                </div>
            </div>
             <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-t dark:border-gray-700">
                <form action="{{ route('admin.reports.activity-log') }}" method="GET" class="w-full md:w-1/2">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-500 dark:text-gray-400"></i>
                        </div>
                        {{-- MODIFICATION START --}}
                        <input type="text" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cari berdasarkan deskripsi..." value="{{ request('search') }}">
                        {{-- MODIFICATION END --}}
                    </div>
                </form>
            </div>

            {{-- Tabel Log Aktivitas --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Waktu</th>
                            <th scope="col" class="px-4 py-3">Deskripsi Aktivitas</th>
                            <th scope="col" class="px-4 py-3">Pengguna</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activities as $activity)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ $activity->created_at->format('d M Y, H:i:s') }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $activity->description }}</td>
                                <td class="px-4 py-3">{{ $activity->causer->name ?? 'Sistem' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="p-8 text-center text-gray-500 dark:text-gray-400">Tidak ada aktivitas yang tercatat.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginasi --}}
            <div class="p-4 border-t dark:border-gray-700">
                {!! $activities->links('vendor.pagination.custom') !!}
            </div>
        </div>
    </div>
</div>
@endsection