{{-- ======================== MODAL TAMBAH ATRIBUT ======================== --}}
<div id="add-attribute-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-md p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Atribut Baru</h3>
                <button type="button" data-modal-toggle="add-attribute-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <i class="fa-solid fa-times w-5 h-5"></i><span class="sr-only">Tutup modal</span>
                </button>
            </div>
            <form action="{{ route('attributes.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Atribut</label>
                        <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="Contoh: Warna" required>
                    </div>
                    <div>
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Input</label>
                        <select name="type" onchange="toggleOptions(this, 'add-options-container')" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
                            <option value="text" selected>Teks (Input bebas)</option>
                            <option value="select">Pilihan (Dropdown)</option>
                        </select>
                    </div>
                    <div id="add-options-container" class="hidden">
                        <label for="options" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opsi Pilihan</label>
                        <input type="text" name="options" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" placeholder="Pisahkan dengan koma, cth: Merah,Biru,Hijau">
                         <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: Merah,Biru,Hijau</p>
                    </div>
                </div>
                <button type="submit" class="w-full mt-6 text-white bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Simpan Atribut
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Script ini harus ada agar show/hide berfungsi --}}
<script>
    function toggleOptions(selectElement, containerId) {
        const container = document.getElementById(containerId);
        if (selectElement.value === 'select') {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }
</script>

