@extends('app.layouts.app')

@section('title', 'Manajemen Supplier')

@section('content')

{{-- Header Halaman --}}
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manajemen Supplier</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola semua data supplier untuk pengadaan barang.</p>
        </div>
        <div class="sm:flex">
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <button type="button" data-modal-target="add-supplier-modal" data-modal-toggle="add-supplier-modal" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <i class="w-5 h-5 mr-2 -ml-1 fa-solid fa-plus"></i>
                    Tambah Supplier
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
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">No</th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Nama Supplier</th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Kontak Person</th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">No. Telepon</th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="supplier-table-body" class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        {{-- Data Dummy Baris 1 --}}
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-sm font-normal text-gray-500">1</td>
                            <td class="p-4 text-sm font-semibold text-gray-900 dark:text-white">PT. Sejahtera Abadi</td>
                            <td class="p-4 text-sm font-normal text-gray-500">Budi Santoso</td>
                            <td class="p-4 text-sm font-normal text-gray-500">081234567890</td>
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <button type="button" 
                                    class="edit-button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-400 hover:bg-yellow-500"
                                    data-modal-target="edit-supplier-modal"
                                    data-modal-toggle="edit-supplier-modal"
                                    data-id="1"
                                    data-name="PT. Sejahtera Abadi"
                                    data-contact_person="Budi Santoso"
                                    data-phone_number="081234567890"
                                    data-email="budi@sejahtera.com"
                                    data-address="Jl. Industri Raya No. 123, Jakarta">
                                    Edit
                                </button>
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk Tambah Supplier --}}
<div id="add-supplier-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    {{-- ... Konten modal tambah supplier tetap sama ... --}}
</div>

{{-- ======================== MODAL EDIT SUPPLIER (BARU) ======================== --}}
<div id="edit-supplier-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-lg p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Supplier</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="edit-supplier-modal">
                    <i class="fa-solid fa-times w-5 h-5"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="#">
                <input type="hidden" id="edit-supplier-id" name="id">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="edit-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier</label>
                        <input type="text" name="name" id="edit-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="edit-contact_person" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kontak Person</label>
                        <input type="text" name="contact_person" id="edit-contact_person" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="edit-phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. Telepon</label>
                        <input type="tel" name="phone_number" id="edit-phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="edit-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="edit-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="edit-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                        <textarea id="edit-address" name="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"></textarea>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update Supplier
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tableBody = document.getElementById('supplier-table-body');
        
        tableBody.addEventListener('click', function(event) {
            const editButton = event.target.closest('.edit-button');
            if (editButton) {
                // Ambil semua data dari atribut 'data-*' pada tombol
                const id = editButton.dataset.id;
                const name = editButton.dataset.name;
                const contactPerson = editButton.dataset.contact_person;
                const phoneNumber = editButton.dataset.phone_number;
                const email = editButton.dataset.email;
                const address = editButton.dataset.address;

                // Isi form di dalam modal edit dengan data tersebut
                document.getElementById('edit-supplier-id').value = id;
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-contact_person').value = contactPerson;
                document.getElementById('edit-phone_number').value = phoneNumber;
                document.getElementById('edit-email').value = email;
                document.getElementById('edit-address').value = address;
            }
        });
    });
</script>
@endpush