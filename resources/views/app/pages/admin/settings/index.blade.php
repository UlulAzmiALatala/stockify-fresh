@extends('app.layouts.app')

@section('title', 'Pengaturan Aplikasi')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Pengaturan Aplikasi</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Atur informasi umum dan branding untuk aplikasi Anda.</p>
    </div>
</div>

<div class="p-4">
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Kolom Kiri: Pengaturan Utama --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white border-b dark:border-gray-700 pb-4 mb-6">Informasi Umum</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="app_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Aplikasi</label>
                            <input type="text" name="app_name" id="app_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ old('app_name', $settings['app_name'] ?? 'Stockify') }}" required>
                            @error('app_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                     <div class="flex justify-start mt-6 border-t dark:border-gray-700 pt-6">
                         <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Logo --}}
            <div class="lg:col-span-1">
                 <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                     <h3 class="text-lg font-semibold text-gray-900 dark:text-white border-b dark:border-gray-700 pb-4 mb-6">Logo Aplikasi</h3>
                     <div class="flex flex-col items-center">
                        {{-- Image Preview --}}
                        <div class="w-full max-w-xs p-2 mb-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                             <img id="logo-preview" 
                                 src="{{ isset($settings['app_logo']) && $settings['app_logo'] ? Storage::url($settings['app_logo']) : 'https://placehold.co/400x200/e2e8f0/64748b?text=Logo+Saat+Ini' }}" 
                                 alt="Logo preview" 
                                 class="h-24 w-full object-contain rounded-md">
                        </div>

                        {{-- Area Upload Gambar --}}
                        <label for="app_logo" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                <i class="fa-solid fa-cloud-arrow-up w-8 h-8 mb-2 text-gray-500 dark:text-gray-400"></i>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk unggah</span></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, SVG (MAKS. 1MB)</p>
                            </div>
                            <input id="app_logo" name="app_logo" type="file" class="hidden" />
                        </label>
                         @error('app_logo') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                     </div>
                 </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoInput = document.getElementById('app_logo');
        const logoPreview = document.getElementById('logo-preview');

        logoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Buat URL sementara untuk file gambar yang dipilih
                logoPreview.src = URL.createObjectURL(file);
            }
        });
    });
</script>
@endpush

