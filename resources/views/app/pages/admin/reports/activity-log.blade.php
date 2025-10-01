@extends('app.layouts.app')

@section('title', 'Laporan Aktivitas Pengguna')

@section('content')

<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            
            {{-- Header Halaman --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Laporan Aktivitas Pengguna</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Melacak semua perubahan penting yang terjadi dalam sistem.</p>
                </div>
            </div>
            
            {{-- Tabel Log Aktivitas --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Waktu</th>
                            <th scope="col" class="px-4 py-3">Pengguna</th>
                            <th scope="col" class="px-4 py-3">Aktivitas</th>
                            <th scope="col" class="px-4 py-3">Target</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activities as $activity)
                            @php
                                // Logika untuk menentukan ikon dan warna berdasarkan event
                                $icon = 'fa-solid fa-info-circle';
                                $color = 'gray';
                                if ($activity->event === 'created') {
                                    $icon = 'fa-solid fa-plus';
                                    $color = 'green';
                                } elseif ($activity->event === 'updated') {
                                    $icon = 'fa-solid fa-pencil';
                                    $color = 'yellow';
                                } elseif ($activity->event === 'deleted') {
                                    $icon = 'fa-solid fa-trash';
                                    $color = 'red';
                                }
                            @endphp
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                {{-- Waktu --}}
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                    {{ $activity->created_at->format('d M Y, H:i') }}
                                </td>
                                {{-- Pengguna --}}
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                    {{ $activity->causer->name ?? 'Sistem' }}
                                </td>
                                {{-- Aktivitas --}}
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 rounded-full bg-{{$color}}-100 dark:bg-{{$color}}-900/50 flex items-center justify-center mr-2">
                                            <i class="{{ $icon }} text-xs text-{{$color}}-600 dark:text-{{$color}}-400"></i>
                                        </div>
                                        <span>{{ $activity->description }}</span>
                                    </div>
                                </td>
                                {{-- Target --}}
                                <td class="px-4 py-3">
                                    <span class="font-mono text-xs bg-gray-100 dark:bg-gray-700 p-1 rounded">
                                        {{ $activity->log_name }}:{{ $activity->subject_id }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                    Belum ada aktivitas yang tercatat.
                                </td>
                            </tr>
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

