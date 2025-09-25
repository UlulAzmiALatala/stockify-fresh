{{-- ======================== MODAL EDIT SUPPLIER ======================== --}}
<div id="edit-supplier-modal-{{ $supplier->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl p-4 md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Supplier</h3>
                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-supplier-modal-{{ $supplier->id }}">
                    <i class="fa-solid fa-times w-5 h-5"></i>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier</label>
                        <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" value="{{ old('name', $supplier->name) }}" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" value="{{ old('email', $supplier->email) }}">
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telepon</label>
                        <input type="text" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700" value="{{ old('phone', $supplier->phone) }}">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                        <textarea name="address" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700">{{ old('address', $supplier->address) }}</textarea>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                     <i class="fas fa-save mr-2"></i>
                    Update Supplier
                </button>
            </form>
        </div>
    </div>
</div>
