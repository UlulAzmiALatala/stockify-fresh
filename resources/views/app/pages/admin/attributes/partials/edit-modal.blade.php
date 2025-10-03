{{-- ======================== MODAL EDIT ATRIBUT (FINAL & BENAR) ======================== --}}
<div id="edit-attribute-modal-{{ $attribute->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-lg p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Atribut: {{ $attribute->name }}</h3>
                <button type="button" data-modal-toggle="edit-attribute-modal-{{ $attribute->id }}" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="fa-solid fa-times w-5 h-5"></i>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            {{-- Form action mengarah ke route untuk update atribut, bukan produk --}}
            <form action="{{ route('attributes.update', $attribute->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    {{-- Input untuk field 'name' dari atribut --}}
                    <div class="sm:col-span-2">
                        <label for="edit-name-{{ $attribute->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Atribut</label>
                        <input type="text" name="name" id="edit-name-{{ $attribute->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" value="{{ old('name', $attribute->name) }}" required placeholder="Contoh: Warna, Ukuran">
                    </div>
                    {{-- Input untuk field 'type' dari atribut --}}
                    <div class="sm:col-span-2">
                        <label for="edit-type-{{ $attribute->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Input</label>
                        <select name="type" id="edit-type-{{ $attribute->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
                            <option value="text" {{ old('type', $attribute->type) == 'text' ? 'selected' : '' }}>Teks</option>
                            <option value="select" {{ old('type', $attribute->type) == 'select' ? 'selected' : '' }}>Pilihan (Select)</option>
                        </select>
                    </div>
                    {{-- Input untuk field 'options' dari atribut --}}
                     <div class="sm:col-span-2">
                        <label for="edit-options-{{ $attribute->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opsi (jika tipe 'select')</label>
                        <textarea name="options" id="edit-options-{{ $attribute->id }}" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600" placeholder="Pisahkan setiap opsi dengan koma, contoh: Merah,Kuning,Hijau">{{ old('options', is_array($attribute->options) ? implode(',', $attribute->options) : $attribute->options) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Hanya diisi jika tipe input adalah 'Pilihan (Select)'.</p>
                    </div>
                </div>
                <div class="flex justify-end pt-4 border-t dark:border-gray-600 mt-4">
                    <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <i class="fas fa-save mr-2"></i>
                        Update Atribut
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>