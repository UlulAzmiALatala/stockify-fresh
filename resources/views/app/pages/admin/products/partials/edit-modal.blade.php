{{-- ======================== MODAL EDIT PRODUK ======================== --}}
<div id="edit-product-modal-{{ $product->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-4xl p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Produk</h3>
                <button type="button" data-modal-toggle="edit-product-modal-{{ $product->id }}" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="fa-solid fa-times w-5 h-5"></i>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
                     {{-- Nama & SKU --}}
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                        <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div>
                        <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                        <input type="text" name="sku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" value="{{ old('sku', $product->sku) }}" required>
                    </div>
                    {{-- Kategori & Supplier --}}
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                        <select name="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" required>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                     {{-- Harga Beli & Jual --}}
                    <div>
                        <label for="purchase_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Beli</label>
                        <input type="number" name="purchase_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" value="{{ old('purchase_price', $product->purchase_price) }}" required>
                    </div>
                    <div>
                        <label for="selling_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Jual</label>
                        <input type="number" name="selling_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" value="{{ old('selling_price', $product->selling_price) }}" required>
                    </div>
                    {{-- Stok Minimum & Gambar --}}
                    <div>
                        <label for="minimum_stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Minimum</label>
                        <input type="number" name="minimum_stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" value="{{ old('minimum_stock', $product->minimum_stock) }}" required>
                    </div>
                    <div class="flex items-end space-x-4">
                        <div class="flex-grow">
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ganti Gambar</label>
                            <input type="file" name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700">
                        </div>
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover rounded-lg">
                        @endif
                    </div>
                    {{-- Deskripsi --}}
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                    <i class="fa-solid fa-save mr-2"></i>
                    Update Produk
                </button>
            </form>
        </div>
    </div>
</div>
