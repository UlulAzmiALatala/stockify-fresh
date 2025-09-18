{{-- Memberitahu Blade untuk menggunakan kerangka utama dari folder layouts --}}
@extends('app.layouts.app')

{{-- Mengatur judul spesifik untuk halaman ini --}}
@section('title', 'Manajemen Kategori')

{{-- Ini adalah bagian konten yang akan dimasukkan ke @yield('content') di layout utama --}}
@section('content')

{{-- Header Halaman --}}
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manajemen Kategori Produk</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola semua kategori produk yang tersedia di sistem.</p>
        </div>
        <div class="sm:flex">
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <button type="button" data-modal-target="add-category-modal" data-modal-toggle="add-category-modal" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Tambah Kategori
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Konten Tabel --}}
<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                No
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Nama Kategori
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        {{-- Data Dummy Baris 1 (Contoh) --}}
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">1</td>
                            <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">Elektronik</td>
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300">Edit</button>
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-900">Hapus</button>
                            </td>
                        </tr>
                        {{-- Data Dummy Baris 2 (Contoh) --}}
                         <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">2</td>
                            <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">Pakaian</td>
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300">Edit</button>
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-900">Hapus</button>
                            </td>
                        </tr>
                         {{-- Data Dummy Baris 3 (Contoh) --}}
                         <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">3</td>
                            <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">Makanan Ringan</td>
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300">Edit</button>
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-900">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk Tambah/Edit Kategori --}}
<div id="add-category-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-md p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Kategori Baru
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-category-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="#">
                <div class="grid gap-4 mb-4 sm:grid-cols-1">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Contoh: Elektronik" required>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initFlowbite();
        // --- KONFIGURASI & VARIABEL GLOBAL ---
        const apiToken = '4|L6VjLfdU3azZWiXfa4ztAmLWak5y4fV2wNt3juWm94cd84a5'; // <<< GANTI TOKEN INI
        const tableBody = document.querySelector('tbody');
        const addCategoryModal = document.getElementById('add-category-modal');
        const modalForm = addCategoryModal.querySelector('form');
        const modalTitle = addCategoryModal.querySelector('h3');
        const modalSubmitButton = addCategoryModal.querySelector('button[type="submit"]');

        let editCategoryId = null; // Untuk melacak ID saat mode edit

        // --- FUNGSI-FUNGSI UTAMA ---

        // 1. Fungsi untuk mengambil dan menampilkan semua kategori
        function fetchCategories() {
            tableBody.innerHTML = '<tr><td colspan="3" class="p-4 text-center">Memuat data...</td></tr>';
            fetch('/api/categories', {
                headers: { 'Authorization': `Bearer ${apiToken}`, 'Accept': 'application/json' }
            })
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = ''; // Kosongkan tabel
                if (data.data.length > 0) {
                    let number = 1;
                    data.data.forEach(category => {
                        const row = document.createElement('tr');
                        row.className = 'hover:bg-gray-100 dark:hover:bg-gray-700';
                        row.innerHTML = `
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">${number++}</td>
                            <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">${category.name}</td>
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <button type="button" class="edit-btn inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-400 hover:bg-yellow-500" data-id="${category.id}">Edit</button>
                                <button type="button" class="delete-btn inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700" data-id="${category.id}">Hapus</button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                } else {
                    tableBody.innerHTML = '<tr><td colspan="3" class="p-4 text-center">Tidak ada data kategori.</td></tr>';
                }
                attachActionListeners(); // Pasang event listener ke tombol baru
            })
            .catch(error => console.error('Error fetching categories:', error));
        }

        // 2. Fungsi untuk memasang event listener pada tombol Edit dan Hapus
        function attachActionListeners() {
            // Event listener untuk tombol Edit
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    editCategoryId = this.dataset.id;
                    // Ambil data kategori spesifik dari API
                    fetch(`/api/categories/${editCategoryId}`, {
                        headers: { 'Authorization': `Bearer ${apiToken}`, 'Accept': 'application/json' }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Isi form dengan data yang ada
                        modalForm.querySelector('#name').value = data.data.name;
                        // Ubah judul dan teks tombol modal
                        modalTitle.textContent = 'Edit Kategori';
                        modalSubmitButton.textContent = 'Simpan Perubahan';
                        // Tampilkan modal (menggunakan toggle dari Flowbite)
                        new Flowbite.Modal(addCategoryModal).show();
                    });
                });
            });

            // Event listener untuk tombol Hapus
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const categoryId = this.dataset.id;
                    if (confirm('Anda yakin ingin menghapus kategori ini?')) {
                        fetch(`/api/categories/${categoryId}`, {
                            method: 'DELETE',
                            headers: { 'Authorization': `Bearer ${apiToken}`, 'Accept': 'application/json' }
                        })
                        .then(response => {
                            if (response.ok) {
                                alert('Kategori berhasil dihapus.');
                                fetchCategories(); // Refresh tabel
                            } else {
                                alert('Gagal menghapus kategori.');
                            }
                        });
                    }
                });
            });
        }

        // --- EVENT LISTENERS ---

        // Event listener untuk tombol "Tambah Kategori"
        document.querySelector('[data-modal-toggle="add-category-modal"]').addEventListener('click', function() {
            editCategoryId = null; // Mode "tambah", bukan "edit"
            modalForm.reset(); // Kosongkan form
            modalTitle.textContent = 'Tambah Kategori Baru';
            modalSubmitButton.textContent = 'Simpan';
        });

        // Event listener untuk form submission di dalam modal
        modalForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(modalForm);
            const data = Object.fromEntries(formData.entries());
            
            const method = editCategoryId ? 'PUT' : 'POST';
            const url = editCategoryId ? `/api/categories/${editCategoryId}` : '/api/categories';
            
            fetch(url, {
                method: method,
                headers: {
                    'Authorization': `Bearer ${apiToken}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.errors) {
                    let errorMessages = Object.values(result.errors).map(error => error[0]).join('\n');
                    alert(`Gagal menyimpan:\n${errorMessages}`);
                } else {
                    alert('Data kategori berhasil disimpan.');
                    new Flowbite.Modal(addCategoryModal).hide(); // Sembunyikan modal
                    fetchCategories(); // Refresh tabel
                }
            })
            .catch(error => console.error('Error submitting form:', error));
        });

        // --- INISIALISASI ---
        fetchCategories(); // Panggil fungsi utama saat halaman dimuat
    });
</script>
@endpush