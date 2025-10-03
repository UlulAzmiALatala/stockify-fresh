{{-- ======================== MODAL TAMBAH PRODUK (FINAL & RAPI) ======================== --}}
<div id="add-product-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        {{-- Konten Modal --}}
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            {{-- Header Modal --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 sticky top-0 bg-white dark:bg-gray-800 z-10">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Produk Baru</h3>
                <button type="button" data-modal-toggle="add-product-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1-5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="fa-solid fa-times w-5 h-5"></i>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>

            {{-- Body Modal (Form) --}}
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Bagian ini yang akan bisa di-scroll --}}
                <div class="p-4 md:p-5 space-y-4 max-h-[70vh] overflow-y-auto">
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2">
                        {{-- Informasi Dasar --}}
                        <div class="sm:col-span-2">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white border-b dark:border-gray-700 pb-2 mb-4">Informasi Dasar</h4>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="Contoh: Laptop ProBook 14" value="{{ old('name') }}" required>
                                    @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                                    <input type="text" name="sku" id="sku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="Contoh: LP-PB-14-001" value="{{ old('sku') }}" required>
                                    @error('sku')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                    <select name="category_id" id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" required>
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                    <select name="supplier_id" id="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" required>
                                        <option value="" disabled selected>Pilih Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                        
                        {{-- Harga & Stok --}}
                        <div class="sm:col-span-2">
                             <h4 class="text-md font-semibold text-gray-900 dark:text-white border-b dark:border-gray-700 pb-2 mb-4">Harga & Stok</h4>
                            <div class="grid gap-4 sm:grid-cols-2">
                                 <div>
                                    <label for="purchase_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Beli</label>
                                    <input type="number" name="purchase_price" id="purchase_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="10000000" value="{{ old('purchase_price') }}" required>
                                    @error('purchase_price')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="selling_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Jual</label>
                                    <input type="number" name="selling_price" id="selling_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="12500000" value="{{ old('selling_price') }}" required>
                                    @error('selling_price')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="minimum_stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Minimum</label>
                                    <input type="number" name="minimum_stock" id="minimum_stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="10" value="{{ old('minimum_stock') }}" required>
                                    @error('minimum_stock')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- Atribut & Deskripsi --}}
                        <div class="sm:col-span-2">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white border-b dark:border-gray-700 pb-2 mb-4">Detail Tambahan</h4>
                              <div class="space-y-4">
                                
                                <div x-data="{ imageUrl: '' }">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Produk</label>
                                    <label for="image" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <template x-if="!imageUrl">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <i class="fa-solid fa-cloud-arrow-up w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"></i>
                                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span></p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG atau GIF</p>
                                            </div>
                                        </template>
                                        <template x-if="imageUrl">
                                            <img :src="imageUrl" class="object-cover w-full h-full rounded-lg">
                                        </template>
                                        <input id="image" type="file" name="image" class="hidden" accept="image/*" @change="imageUrl = URL.createObjectURL($event.target.files[0])">
                                    </label>
                                    @error('image')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Atribut Tambahan</label>
                                    {{-- ======================================== --}}
                                    {{-- == PERBAIKAN: LAYOUT MENJADI 3 KOLOM == --}}
                                    {{-- ======================================== --}}
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        @foreach ($attributes as $attribute)
                                            <div>
                                                <label for="attribute-{{ $attribute->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $attribute->name }}</label>
                                                @if($attribute->type == 'select')
                                                    <select name="attributes[{{ $attribute->id }}]" id="attribute-{{ $attribute->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
                                                        <option value="">Pilih {{ $attribute->name }}</option>
                                                        @foreach($attribute->options as $option)
                                                            <option value="{{ $option }}" {{ old('attributes.'.$attribute->id) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="text" name="attributes[{{ $attribute->id }}]" id="attribute-{{ $attribute->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" value="{{ old('attributes.'.$attribute->id) }}" placeholder="Nilai...">
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                 <div>
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600" placeholder="Tulis deskripsi produk di sini...">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer Modal --}}
                <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                        <i class="fa-solid fa-save mr-2"></i>
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>