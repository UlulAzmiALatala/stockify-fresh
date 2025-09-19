@extends('app.layouts.app')

@section('title', 'Manajemen Produk')

@section('content')

{{-- Header Halaman --}}
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manajemen Produk</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola semua produk, termasuk stok, harga, dan atribut lainnya.</p>
        </div>
        <div class="sm:flex">
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <button type="button" data-modal-target="add-product-modal" data-modal-toggle="add-product-modal" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <i class="w-5 h-5 mr-2 -ml-1 fa-solid fa-plus"></i>
                    Tambah Produk
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
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Nama Produk</th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Kategori</th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Harga Jual</th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Stok</th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="product-table-body" class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        {{-- Data Dummy Baris 1 --}}
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">Laptop ProBook 14"</td>
                            <td class="p-4 text-sm font-normal text-gray-500 dark:text-gray-400">Elektronik</td>
                            <td class="p-4 text-sm font-semibold text-gray-900 dark:text-white">Rp 12.500.000</td>
                            <td class="p-4 text-sm font-semibold text-gray-900 dark:text-white">50</td>
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                {{-- Tombol Edit dengan data attributes untuk di-tangkap JavaScript --}}
                                <button type="button" 
                                    class="edit-button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-400 hover:bg-yellow-500"
                                    data-modal-target="edit-product-modal" 
                                    data-modal-toggle="edit-product-modal"
                                    data-id="1"
                                    data-name="Laptop ProBook 14&quot;"
                                    data-sku="LP-PB-14-001"
                                    data-category="elektronik"
                                    data-supplier="supplier2"
                                    data-purchase_price="10000000"
                                    data-selling_price="12500000"
                                    data-description="Deskripsi singkat laptop ProBook.">
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

{{-- ======================== MODAL TAMBAH PRODUK ======================== --}}
<div id="add-product-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-4xl p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Produk Baru</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="add-product-modal">
                    <i class="fa-solid fa-times w-5 h-5"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="#">
                {{-- ... (Isi form sama seperti sebelumnya) ... --}}
            </form>
        </div>
    </div>
</div>

{{-- ======================== MODAL EDIT PRODUK (BARU) ======================== --}}
<div id="edit-product-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-4xl p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Produk</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="edit-product-modal">
                    <i class="fa-solid fa-times w-5 h-5"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="#">
                {{-- Input tersembunyi untuk menyimpan ID produk yang akan di-update --}}
                <input type="hidden" id="edit-product-id" name="id">
                
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="edit-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                        <input type="text" name="name" id="edit-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="edit-sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                        <input type="text" name="sku" id="edit-sku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="edit-category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select id="edit-category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <option value="elektronik">Elektronik</option>
                            <option value="pakaian">Pakaian</option>
                        </select>
                    </div>
                    <div>
                        <label for="edit-supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                        <select id="edit-supplier" name="supplier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <option value="supplier1">PT. Sejahtera Abadi</option>
                            <option value="supplier2">CV. Maju Jaya Elektronik</option>
                        </select>
                    </div>
                    <div>
                        <label for="edit-purchase_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Beli</label>
                        <input type="number" name="purchase_price" id="edit-purchase_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="edit-selling_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Jual</label>
                        <input type="number" name="selling_price" id="edit-selling_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="edit-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea id="edit-description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"></textarea>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update Produk
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Event listener untuk semua tombol edit di dalam tabel
        const tableBody = document.getElementById('product-table-body');
        
        tableBody.addEventListener('click', function(event) {
            // Cek apakah yang diklik adalah tombol dengan class 'edit-button'
            const editButton = event.target.closest('.edit-button');
            if (editButton) {
                // 1. Dapatkan semua data dari atribut 'data-*' pada tombol
                const id = editButton.dataset.id;
                const name = editButton.dataset.name;
                const sku = editButton.dataset.sku;
                const category = editButton.dataset.category;
                const supplier = editButton.dataset.supplier;
                const purchasePrice = editButton.dataset.purchase_price;
                const sellingPrice = editButton.dataset.selling_price;
                const description = editButton.dataset.description;

                // 2. Isi form di dalam modal edit dengan data tersebut
                document.getElementById('edit-product-id').value = id;
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-sku').value = sku;
                document.getElementById('edit-category').value = category;
                document.getElementById('edit-supplier').value = supplier;
                document.getElementById('edit-purchase_price').value = purchasePrice;
                document.getElementById('edit-selling_price').value = sellingPrice;
                document.getElementById('edit-description').value = description;
            }
        });
    });
</script>
@endpush