@extends('app.layouts.app')

@section('title', 'Pengaturan Aplikasi')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Pengaturan Aplikasi</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Atur informasi umum untuk aplikasi Anda.</p>
    </div>
</div>

<div class="p-4">
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-400" role="alert">{{ session('success') }}</div>
    @endif

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                {{-- Nama Aplikasi --}}
                <div>
                    <label for="app_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Aplikasi</label>
                    {{-- MODIFICATION START --}}
                    <input type="text" name="app_name" id="app_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('app_name', $settings['app_name'] ?? 'Stockify') }}" required>
                    {{-- MODIFICATION END --}}
                    @error('app_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Logo Aplikasi --}}
                <div class="flex items-end space-x-4">
                    <div class="flex-grow">
                        <label for="app_logo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo Aplikasi</label>
                        <input type="file" name="app_logo" id="app_logo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, SVG (MAKS. 1MB)</p>
                        @error('app_logo') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    @if(isset($settings['app_logo']) && $settings['app_logo'])
                        <img src="{{ Storage::url($settings['app_logo']) }}" alt="Logo saat ini" class="h-16 w-auto object-contain rounded-lg bg-gray-100 dark:bg-gray-700 p-1">
                    @endif
                </div>
            </div>

            <div class="flex justify-end mt-6">
                 <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection