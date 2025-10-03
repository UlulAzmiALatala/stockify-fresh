{{-- ======================== MODAL DELETE ATRIBUT (FINAL & BENAR) ======================== --}}
<div id="delete-attribute-modal-{{ $attribute->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-md p-4 md:h-auto">
        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="delete-attribute-modal-{{ $attribute->id }}">
                <i class="fa-solid fa-times w-5 h-5"></i>
                <span class="sr-only">Tutup modal</span>
            </button>
            <i class="fa-solid fa-trash-can text-gray-400 dark:text-gray-500 w-11 h-11 mx-auto mb-3.5"></i>
            <p class="mb-4 text-gray-500 dark:text-gray-300">
                Apakah Anda yakin ingin menghapus atribut <span class="font-bold">"{{ $attribute->name }}"</span>?
            </p>
            <div class="flex items-center justify-center space-x-4">
                <button data-modal-toggle="delete-attribute-modal-{{ $attribute->id }}" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">
                    Batal
                </button>
                {{-- Form ini hanya berisi tombol submit untuk menghapus --}}
                <form action="{{ route('attributes.destroy', $attribute->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>