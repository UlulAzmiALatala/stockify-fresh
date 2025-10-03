{{-- ======================== MODAL EDIT PRODUK (FINAL & RAPI) ======================== --}}
<div id="edit-product-modal-{{ $product->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        {{-- Konten Modal --}}
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            {{-- Header Modal --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 sticky top-0 bg-white dark:bg-gray-800 z-10">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Produk: {{ $product->name }}</h3>
                <button type="button" data-modal-toggle="edit-product-modal-{{ $product->id }}" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="fa-solid fa-times w-5 h-5"></i>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>

            {{-- Body Modal (Form) --}}
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                {{-- Bagian ini yang akan bisa di-scroll --}}
                <div class="p-4 md:p-5 space-y-4 max-h-[70vh] overflow-y-auto">
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2">
                        {{-- Informasi Dasar --}}
                        <div class="sm:col-span-2">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white border-b dark:border-gray-700 pb-2 mb-4">Informasi Dasar</h4>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="edit-name-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                                    <input type="text" name="name" id="edit-name-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" value="{{ old('name', $product->name) }}" required>
                                </div>
                                <div>
                                    <label for="edit-sku-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                                    <input type="text" name="sku" id="edit-sku-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" value="{{ old('sku', $product->sku) }}" required>
                                </div>
                                <div>
                                    <label for="edit-category_id-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                    <select name="category_id" id="edit-category_id-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="edit-supplier_id-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                    <select name="supplier_id" id="edit-supplier_id-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" required>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Harga & Stok --}}
                        <div class="sm:col-span-2">
                             <h4 class="text-md font-semibold text-gray-900 dark:text-white border-b dark:border-gray-700 pb-2 mb-4">Harga & Stok</h4>
                            <div class="grid gap-4 sm:grid-cols-2">
                                 <div>
                                    <label for="edit-purchase_price-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Beli</label>
                                    <input type="number" name="purchase_price" id="edit-purchase_price-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" value="{{ old('purchase_price', $product->purchase_price) }}" required>
                                </div>
                                <div>
                                    <label for="edit-selling_price-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Jual</label>
                                    <input type="number" name="selling_price" id="edit-selling_price-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" value="{{ old('selling_price', $product->selling_price) }}" required>
                                </div>
                                <div>
                                    <label for="edit-minimum_stock-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Minimum</label>
                                    <input type="number" name="minimum_stock" id="edit-minimum_stock-{{$product->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" value="{{ old('minimum_stock', $product->minimum_stock) }}" required>
                                </div>
                            </div>
                        </div>

                        {{-- Atribut & Deskripsi --}}
                        <div class="sm:col-span-2">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white border-b dark:border-gray-700 pb-2 mb-4">Detail Tambahan</h4>
                              <div class="space-y-4">
                                
                                {{-- ============================================= --}}
                                {{-- == BAGIAN PREVIEW GAMBAR YANG DIPERBARUI == --}}
                                {{-- ============================================= --}}
                                <div x-data="{ imageUrl: '{{ $product->image ? Storage::url($product->image) : '' }}' }">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Produk</label>
                                    <label for="edit-image-{{$product->id}}" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <template x-if="!imageUrl">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <i class="fa-solid fa-cloud-arrow-up w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"></i>
                                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk ganti gambar</span></p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG atau GIF</p>
                                            </div>
                                        </template>
                                        <template x-if="imageUrl">
                                            <img :src="imageUrl" class="object-cover w-full h-full rounded-lg">
                                        </template>
                                        <input id="edit-image-{{$product->id}}" type="file" name="image" class="hidden" accept="image/*" @change="imageUrl = URL.createObjectURL($event.target.files[0])">
                                    </label>
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Atribut Tambahan</label>
                                    {{-- ======================================== --}}
                                    {{-- == LAYOUT ATRIBUT MENJADI 3 KOLOM == --}}
                                    {{-- ======================================== --}}
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        @foreach ($attributes as $attribute)
                                            <div>
                                                @php
                                                    $existingAttribute = $product->productAttributes->find($attribute->id);
                                                    $value = $existingAttribute ? $existingAttribute->pivot->value : '';
                                                @endphp
                                                <label for="edit-attribute-{{ $product->id }}-{{ $attribute->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $attribute->name }}</label>
                                                @if($attribute->type == 'select')
                                                    <select name="attributes[{{ $attribute->id }}]" id="edit-attribute-{{ $product->id }}-{{ $attribute->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
                                                        <option value="">Pilih {{ $attribute->name }}</option>
                                                        @foreach($attribute->options as $option)
                                                            <option value="{{ $option }}" {{ $value == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="text" name="attributes[{{ $attribute->id }}]" id="edit-attribute-{{ $product->id }}-{{ $attribute->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" value="{{ $value }}" placeholder="Nilai...">
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                 <div>
                                    <label for="edit-description-{{$product->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                    <textarea id="edit-description-{{$product->id}}" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600" placeholder="Tulis deskripsi produk di sini...">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer Modal --}}
                <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                        <i class="fas fa-save mr-2"></i>
                        Update Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>