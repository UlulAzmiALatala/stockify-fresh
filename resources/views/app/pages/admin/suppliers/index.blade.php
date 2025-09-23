@extends('app.layouts.app')

@section('title', 'Manajemen Supplier')

@section('content')

{{-- Bagian Konten Utama --}}
<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            
            {{-- Header Tabel (Judul, Search, Tombol Tambah) --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Supplier</h2>
                    <form class="flex items-center">
                        <label for="supplier-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                            </div>
                            <input type="text" id="supplier-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="Cari supplier...">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" data-modal-target="add-supplier-modal" data-modal-toggle="add-supplier-modal" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                        <i class="fa-solid fa-plus h-3.5 w-3.5 mr-2"></i>
                        Tambah Supplier
                    </button>
                </div>
            </div>
            
            {{-- Tabel Supplier --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Supplier</th>
                            <th scope="col" class="px-4 py-3">Alamat</th>
                            <th scope="col" class="px-4 py-3">Telepon</th>
                            <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="supplier-table-body">
                        {{-- Data diisi oleh JS --}}
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
</div>

{{-- ======================== MODAL TAMBAH SUPPLIER ======================== --}}
<div id="add-supplier-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Supplier Baru</h3>
                <button type="button" id="close-add-modal" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="add-supplier-modal"><i class="fa-solid fa-times w-5 h-5"></i></button>
            </div>
            <form id="add-supplier-form">
                <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
                    <div><label for="add-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier</label><input type="text" id="add-name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required></div>
                    <div><label for="add-phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telepon</label><input type="text" id="add-phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></div>
                    <div class="sm:col-span-2"><label for="add-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label><textarea id="add-address" name="address" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"></textarea></div>
                </div>
                <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">Simpan Supplier</button>
            </form>
        </div>
    </div>
</div>

{{-- ======================== MODAL EDIT SUPPLIER ======================== --}}
<div id="edit-supplier-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Supplier</h3>
                <button type="button" id="close-edit-modal" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="edit-supplier-modal"><i class="fa-solid fa-times w-5 h-5"></i></button>
            </div>
            <form id="edit-supplier-form">
                <input type="hidden" id="edit-id" name="id">
                <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
                    <div><label for="edit-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier</label><input type="text" id="edit-name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required></div>
                    <div><label for="edit-phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telepon</label><input type="text" id="edit-phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></div>
                    <div class="sm:col-span-2"><label for="edit-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label><textarea id="edit-address" name="address" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"></textarea></div>
                </div>
                <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">Update Supplier</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tableBody = document.getElementById('supplier-table-body');
    const addForm = document.getElementById('add-supplier-form');
    const editForm = document.getElementById('edit-supplier-form');
    const closeModalAddButton = document.getElementById('close-add-modal');
    const closeModalEditButton = document.getElementById('close-edit-modal');

    // Mock data supplier
    let mockSuppliers = [
        { id: 1, name: 'PT. Sejahtera Abadi', address: 'Jl. Merdeka No. 123, Jakarta', phone: '021-987654' },
        { id: 2, name: 'CV. Maju Jaya Elektronik', address: 'Jl. Sudirman No. 45, Bandung', phone: '022-765432' }
    ];

    // Render tabel supplier
    function renderTable() {
        tableBody.innerHTML = '';
        if (mockSuppliers.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="4" class="text-center p-4">Tidak ada data supplier.</td></tr>`;
            return;
        }
        mockSuppliers.forEach(sup => {
            const row = `
                <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">${sup.name}</td>
                    <td class="px-4 py-3">${sup.address}</td>
                    <td class="px-4 py-3">${sup.phone}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <button type="button" class="edit-button bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md mr-2"
                            data-modal-target="edit-supplier-modal" data-modal-toggle="edit-supplier-modal"
                            data-id="${sup.id}" data-name="${sup.name}" data-address="${sup.address}" data-phone="${sup.phone}">
                            Edit
                        </button>
                        <button type="button" class="delete-button bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md" data-id="${sup.id}">Hapus</button>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    }

    // Tambah supplier
    addForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const newSupplier = {
            id: Date.now(),
            name: document.getElementById('add-name').value,
            phone: document.getElementById('add-phone').value,
            address: document.getElementById('add-address').value,
        };
        mockSuppliers.push(newSupplier);
        renderTable();
        addForm.reset();
        closeModalAddButton.click();
        alert('Supplier berhasil ditambahkan!');
    });

    // Isi form edit
    tableBody.addEventListener('click', function(e) {
        const editBtn = e.target.closest('.edit-button');
        if (editBtn) {
            document.getElementById('edit-id').value = editBtn.dataset.id;
            document.getElementById('edit-name').value = editBtn.dataset.name;
            document.getElementById('edit-phone').value = editBtn.dataset.phone;
            document.getElementById('edit-address').value = editBtn.dataset.address;
        }
    });

    // Update supplier
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('edit-id').value;
        const idx = mockSuppliers.findIndex(s => s.id == id);
        if (idx !== -1) {
            mockSuppliers[idx].name = document.getElementById('edit-name').value;
            mockSuppliers[idx].phone = document.getElementById('edit-phone').value;
            mockSuppliers[idx].address = document.getElementById('edit-address').value;
        }
        renderTable();
        closeModalEditButton.click();
        alert('Supplier berhasil diperbarui!');
    });

    // Hapus supplier
    tableBody.addEventListener('click', function(e) {
        const deleteBtn = e.target.closest('.delete-button');
        if (deleteBtn) {
            const id = deleteBtn.dataset.id;
            if (confirm('Yakin ingin menghapus supplier ini?')) {
                mockSuppliers = mockSuppliers.filter(s => s.id != id);
                renderTable();
                alert('Supplier berhasil dihapus!');
            }
        }
    });

    renderTable();
});
</script>
@endpush
