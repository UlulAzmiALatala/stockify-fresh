@extends('app.layouts.app')

@section('title', 'Tambah Kategori Baru')

@section('content')
    <div class="p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Tambah Kategori Baru
        </h1>

        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            {{-- Form untuk membuat kategori baru --}}
            <form id="create-category-form">
                <div class="grid grid-cols-1 gap-6">
                    {{-- Nama Kategori --}}
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Contoh: Elektronik" required>
                    </div>
                    {{-- Deskripsi --}}
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Deskripsi singkat kategori..."></textarea>
                    </div>
                </div>
                {{-- Tombol Submit --}}
                <div class="flex justify-end mt-6">
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Simpan Kategori
                    </button>
                </div>
            </form>

            {{-- Tempat untuk menampilkan pesan sukses atau error --}}
            <div id="response-message" class="mt-4"></div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('create-category-form');
        const responseMessage = document.getElementById('response-message');
        const apiToken = '4|L6VjLfdU3azZWiXfa4ztAmLWak5y4fV2wNt3juWm94cd84a5'; 

        form.addEventListener('submit', function(event) {
            // Hentikan aksi default form (reload halaman)
            event.preventDefault();
            
            // Tampilkan pesan loading
            responseMessage.innerHTML = '<p class="text-blue-500">Menyimpan...</p>';

            // Kumpulkan data dari form
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            // Kirim data ke API menggunakan Fetch
            fetch('/api/categories', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${apiToken}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                // Periksa apakah ada error validasi dari Laravel
                if (result.errors) {
                    let errorMessages = '';
                    for (const key in result.errors) {
                        errorMessages += `<p class="text-red-500">- ${result.errors[key][0]}</p>`;
                    }
                    responseMessage.innerHTML = errorMessages;
                } else {
                    // Jika sukses
                    responseMessage.innerHTML = '<p class="text-green-500">Kategori berhasil disimpan!</p>';
                    form.reset(); // Kosongkan form setelah berhasil
                }
            })
            .catch(error => {
                console.error('Error:', error);
                responseMessage.innerHTML = '<p class="text-red-500">Terjadi kesalahan. Silakan coba lagi.</p>';
            });
        });
    });
</script>
@endpush