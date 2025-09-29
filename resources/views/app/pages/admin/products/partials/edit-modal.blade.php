{{-- ======================== MODAL EDIT PRODUK (DARK MODE FIXED) ======================== --}}
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
                    {{-- Nama Produk --}}
                    <div>
                        <label for="name-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                        <input type="text" name="name" id="name-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" value="{{ old('name', $product->name) }}" required>
                    </div>
                    {{-- SKU --}}
                    <div>
                        <label for="sku-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                        <input type="text" name="sku" id="sku-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" value="{{ old('sku', $product->sku) }}" required>
                    </div>
                    {{-- Kategori --}}
                    <div>
                        <label for="category_id-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select name="category_id" id="category_id-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Supplier --}}
                    <div>
                        <label for="supplier_id-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                        <select name="supplier_id" id="supplier_id-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" required>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Harga Beli --}}
                    <div>
                        <label for="purchase_price-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Beli</label>
                        <input type="number" name="purchase_price" id="purchase_price-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" value="{{ old('purchase_price', $product->purchase_price) }}" required>
                    </div>
                    {{-- Harga Jual --}}
                    <div>
                        <label for="selling_price-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Jual</label>
                        <input type="number" name="selling_price" id="selling_price-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" value="{{ old('selling_price', $product->selling_price) }}" required>
                    </div>
                    {{-- Stok Minimum --}}
                    <div>
                        <label for="minimum_stock-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Minimum</label>
                        <input type="number" name="minimum_stock" id="minimum_stock-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" value="{{ old('minimum_stock', $product->minimum_stock) }}" required>
                    </div>
                    {{-- Ganti Gambar --}}
                    <div class="flex items-end space-x-4">
                        <div class="flex-grow">
                            <label for="image-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ganti Gambar</label>
                            <input type="file" name="image" id="image-{{$product->id}}" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </div>
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover rounded-lg">
                        @endif
                    </div>
                    {{-- Deskripsi --}}
                    <div class="sm:col-span-2">
                        <label for="description-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="description" id="description-{{$product->id}}" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-600 focus:border-indigo-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
                {{-- Tombol Update --}}
                <button type="submit" class="text-white inline-flex items-center bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-500 dark:hover:bg-indigo-600 dark:focus:ring-indigo-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path></svg>
                    Update Produk
                </button>
            </form>
        </div>
    </div>
</div>

