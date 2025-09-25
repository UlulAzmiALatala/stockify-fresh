@extends('app.layouts.app')

@section('title', 'Manajemen Produk')

@section('content')

{{-- Bagian Konten Utama --}}
<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            {{-- Header Tabel (Filter, Search, Tombol Tambah) --}}
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                            </div>
                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="Cari produk...">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    {{-- Ganti data-modal-toggle dengan ID untuk JS kustom --}}
                    <button type="button" id="open-add-modal" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                        <i class="fa-solid fa-plus h-3.5 w-3.5 mr-2"></i>
                        Tambah Produk
                    </button>
                </div>
            </div>

            {{-- Tabel Produk (Dengan Wrapper Responsif) --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Produk</th>
                            <th scope="col" class="px-4 py-3">Kategori</th>
                            <th scope="col" class="px-4 py-3">Harga Jual</th>
                            <th scope="col" class="px-4 py-3">Stok</th>
                            <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="product-table-body">
                        {{-- Data akan diisi oleh JavaScript --}}
                    </tbody>
                </table>
            </div>

            {{-- Paginasi (Statis untuk contoh) --}}
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Menampilkan <span id="pagination-info" class="font-semibold text-gray-900 dark:text-white">1-3 dari 3</span>
                </span>
                <ul class="inline-flex items-stretch -space-x-px">
                    <li><a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100">Previous</a></li>
                    <li><a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300">1</a></li>
                    <li><a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

{{-- ======================== MODAL TAMBAH PRODUK ======================== --}}
<div id="add-product-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-4xl p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Produk Baru</h3>
                <button type="button" id="close-add-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"><i class="fa-solid fa-times w-5 h-5"></i></button>
            </div>
            <form id="add-product-form">
                <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
                    <div><label for="add-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label><input type="text" id="add-name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Contoh: Laptop ProBook 14" required></div>
                    <div><label for="add-sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label><input type="text" id="add-sku" name="sku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Contoh: LP-PB-14-001" required></div>
                    <div><label for="add-category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label><select id="add-category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></select></div>
                    <div><label for="add-supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label><select id="add-supplier" name="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></select></div>
                    <div><label for="add-purchase_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Beli</label><input type="number" id="add-purchase_price" name="purchase_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="10000000" required></div>
                    <div><label for="add-selling_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Jual</label><input type="number" id="add-selling_price" name="selling_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="12500000" required></div>
                    <div class="sm:col-span-2"><label for="add-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label><textarea id="add-description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" placeholder="Tulis deskripsi produk di sini..."></textarea></div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan Produk</button>
            </form>
        </div>
    </div>
</div>

{{-- ======================== MODAL EDIT PRODUK ======================== --}}
<div id="edit-product-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-4xl p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Produk</h3>
                <button type="button" id="close-edit-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"><i class="fa-solid fa-times w-5 h-5"></i></button>
            </div>
            <form id="edit-product-form">
                <input type="hidden" id="edit-product-id" name="id">
                <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
                    <div><label for="edit-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label><input type="text" id="edit-name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required></div>
                    <div><label for="edit-sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label><input type="text" id="edit-sku" name="sku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required></div>
                    <div><label for="edit-category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label><select id="edit-category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></select></div>
                    <div><label for="edit-supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label><select id="edit-supplier" name="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></select></div>
                    <div><label for="edit-purchase_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Beli</label><input type="number" id="edit-purchase_price" name="purchase_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required></div>
                    <div><label for="edit-selling_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Jual</label><input type="number" id="edit-selling_price" name="selling_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required></div>
                    <div class="sm:col-span-2"><label for="edit-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label><textarea id="edit-description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"></textarea></div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update Produk</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Elemen-elemen Form ---
    const tableBody = document.getElementById('product-table-body');
    const addForm = document.getElementById('add-product-form');
    const editForm = document.getElementById('edit-product-form');
    const closeModalAddButton = document.getElementById('close-add-modal');
    const closeModalEditButton = document.getElementById('close-edit-modal');
    const paginationInfo = document.getElementById('pagination-info');

    // ===================================================================
    // DATABASE SEMENTARA (MOCK DATA)
    // ===================================================================
    let mockProducts = [
        { id: 1, name: 'Laptop ProBook 14"', sku: 'LP-PB-14-001', category: { id: 1, name: 'Elektronik' }, supplier: { id: 2, name: 'CV. Maju Jaya Elektronik' }, purchase_price: 10000000, selling_price: 12500000, stock: 50, description: 'Deskripsi singkat laptop ProBook.' },
        { id: 2, name: 'Kaos Polos Katun', sku: 'KAOS-PL-KTN-01', category: { id: 2, name: 'Pakaian' }, supplier: { id: 1, name: 'PT. Sejahtera Abadi' }, purchase_price: 50000, selling_price: 75000, stock: 120, description: 'Kaos polos bahan katun combed 30s.' },
        { id: 3, name: 'Mouse Wireless Silent', sku: 'MS-WL-SLN-03', category: { id: 1, name: 'Elektronik' }, supplier: { id: 2, name: 'CV. Maju Jaya Elektronik' }, purchase_price: 80000, selling_price: 115000, stock: 75, description: 'Mouse wireless tanpa suara klik.' }
    ];
    let mockCategories = [{ id: 1, name: 'Elektronik' }, { id: 2, name: 'Pakaian' }];
    let mockSuppliers = [{ id: 1, name: 'PT. Sejahtera Abadi' }, { id: 2, name: 'CV. Maju Jaya Elektronik' }];

    // ===================================================================
    // FUNGSI UNTUK MENAMPILKAN DATA (READ)
    // ===================================================================
    function renderTable() {
        tableBody.innerHTML = '';
        if (mockProducts.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="5" class="text-center p-4">Tidak ada data produk.</td></tr>`;
            paginationInfo.textContent = '0-0 dari 0';
            return;
        }
        mockProducts.forEach(product => {
            const row = `
                <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">${product.name}</th>
                    <td class="px-4 py-3">${product.category.name}</td>
                    <td class="px-4 py-3">${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(product.selling_price)}</td>
                    <td class="px-4 py-3">${product.stock}</td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <button type="button" class="edit-button inline-flex items-center px-3 py-1 text-sm font-medium text-center text-white rounded-md bg-yellow-400 hover:bg-yellow-500"
                            data-modal-target="edit-product-modal" data-modal-toggle="edit-product-modal"
                            data-id="${product.id}" data-name="${product.name}" data-sku="${product.sku}" data-category_id="${product.category.id}"
                            data-supplier_id="${product.supplier.id}" data-purchase_price="${product.purchase_price}"
                            data-selling_price="${product.selling_price}" data-description="${product.description}">Edit</button>
                        <button type="button" data-id="${product.id}" class="delete-button ml-2 inline-flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-red-600 rounded-md hover:bg-red-700">Hapus</button>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
        paginationInfo.textContent = `1-${mockProducts.length} dari ${mockProducts.length}`;
    }
    
    // ===================================================================
    // FUNGSI UNTUK MENGISI OPSI DROPDOWN
    // ===================================================================
    function populateDropdowns() {
        const selects = {
            addCategory: document.getElementById('add-category'),
            editCategory: document.getElementById('edit-category'),
            addSupplier: document.getElementById('add-supplier'),
            editSupplier: document.getElementById('edit-supplier')
        };
        selects.addCategory.innerHTML = '<option selected disabled>Pilih Kategori</option>';
        selects.editCategory.innerHTML = '';
        mockCategories.forEach(cat => {
            const option = `<option value="${cat.id}">${cat.name}</option>`;
            selects.addCategory.innerHTML += option;
            selects.editCategory.innerHTML += option;
        });
        selects.addSupplier.innerHTML = '<option selected disabled>Pilih Supplier</option>';
        selects.editSupplier.innerHTML = '';
        mockSuppliers.forEach(sup => {
            const option = `<option value="${sup.id}">${sup.name}</option>`;
            selects.addSupplier.innerHTML += option;
            selects.editSupplier.innerHTML += option;
        });
    }

    // ===================================================================
    // FUNGSI UNTUK MENAMBAH DATA (CREATE)
    // ===================================================================
    addForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const newProduct = {
            id: Date.now(),
            name: document.getElementById('add-name').value,
            sku: document.getElementById('add-sku').value,
            category: mockCategories.find(c => c.id == document.getElementById('add-category').value) || {id: null, name: 'N/A'},
            supplier: mockSuppliers.find(s => s.id == document.getElementById('add-supplier').value) || {id: null, name: 'N/A'},
            purchase_price: parseFloat(document.getElementById('add-purchase_price').value),
            selling_price: parseFloat(document.getElementById('add-selling_price').value),
            stock: 0,
            description: document.getElementById('add-description').value,
        };
        mockProducts.push(newProduct);
        renderTable();
        addForm.reset();
        closeModalAddButton.click();
        alert('Produk baru berhasil ditambahkan!');
    });
    
    // ===================================================================
    // FUNGSI UNTUK MENGISI & MENGIRIM FORM EDIT (UPDATE)
    // ===================================================================
    tableBody.addEventListener('click', function(event) {
        const editButton = event.target.closest('.edit-button');
        if (editButton) {
            document.getElementById('edit-product-id').value = editButton.dataset.id;
            document.getElementById('edit-name').value = editButton.dataset.name;
            document.getElementById('edit-sku').value = editButton.dataset.sku;
            document.getElementById('edit-category').value = editButton.dataset.category_id;
            document.getElementById('edit-supplier').value = editButton.dataset.supplier_id;
            document.getElementById('edit-purchase_price').value = editButton.dataset.purchase_price;
            document.getElementById('edit-selling_price').value = editButton.dataset.selling_price;
            document.getElementById('edit-description').value = editButton.dataset.description;
        }
    });
    
    editForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const idToUpdate = document.getElementById('edit-product-id').value;
        const productIndex = mockProducts.findIndex(p => p.id == idToUpdate);
        
        if (productIndex !== -1) {
            mockProducts[productIndex].name = document.getElementById('edit-name').value;
            mockProducts[productIndex].sku = document.getElementById('edit-sku').value;
            mockProducts[productIndex].category = mockCategories.find(c => c.id == document.getElementById('edit-category').value);
            mockProducts[productIndex].supplier = mockSuppliers.find(s => s.id == document.getElementById('edit-supplier').value);
            mockProducts[productIndex].purchase_price = parseFloat(document.getElementById('edit-purchase_price').value);
            mockProducts[productIndex].selling_price = parseFloat(document.getElementById('edit-selling_price').value);
            mockProducts[productIndex].description = document.getElementById('edit-description').value;
        }
        
        renderTable();
        closeModalEditButton.click();
        alert('Produk berhasil diperbarui!');
    });

    // ===================================================================
    // FUNGSI UNTUK MENGHAPUS DATA (DELETE)
    // ===================================================================
    tableBody.addEventListener('click', function(event) {
        const deleteButton = event.target.closest('.delete-button');
        if (deleteButton) {
            const idToDelete = deleteButton.dataset.id;
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                mockProducts = mockProducts.filter(p => p.id != idToDelete);
                renderTable();
                alert('Produk berhasil dihapus.');
            }
        }
    });

    // ===================================================================
    // FUNGSI UNTUK MEMBUKA DAN MENUTUP MODAL
    // ===================================================================
    const addModal = document.getElementById('add-product-modal');
    const editModal = document.getElementById('edit-product-modal');

    document.getElementById('open-add-modal').addEventListener('click', () => {
        addModal.classList.remove('hidden');
        addModal.setAttribute('aria-hidden', 'false');
    });

    closeModalAddButton.addEventListener('click', () => {
        addModal.classList.add('hidden');
        addModal.setAttribute('aria-hidden', 'true');
    });

    tableBody.addEventListener('click', (event) => {
        const editButton = event.target.closest('.edit-button');
        if (editButton) {
            editModal.classList.remove('hidden');
            editModal.setAttribute('aria-hidden', 'false');
        }
    });

    closeModalEditButton.addEventListener('click', () => {
        editModal.classList.add('hidden');
        editModal.setAttribute('aria-hidden', 'true');
    });
    
    // ===================================================================
    // INISIALISASI
    // ===================================================================
    populateDropdowns();
    renderTable();
});
</script>
@endpush