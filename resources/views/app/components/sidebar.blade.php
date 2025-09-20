<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full sm:translate-x-0">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            {{-- <li> Menu Anda dimulai di sini --}}
           <li>
    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-indigo-500 dark:hover:bg-indigo-600 group transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-110">
        <i class="w-6 text-center fa-solid fa-chart-pie text-gray-500 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white"></i>
        <span class="ms-3">Dashboard</span>
    </a>
</li>

            {{-- 2. Menu Dropdown Transaksi --}}
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 dark:text-white rounded-lg group hover:bg-indigo-500 dark:hover:bg-indigo-600 hover:text-white transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 {{ Request::is('admin/transaksi/*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}" aria-controls="dropdown-transactions" data-collapse-toggle="dropdown-transactions">
                    <i class="w-6 text-center text-gray-500 fa-solid fa-arrow-right-arrow-left transition duration-75 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Transaksi</span>
                    <i class="fa-solid fa-chevron-down text-gray-500 dark:text-gray-400"></i>
                </button>
                <ul id="dropdown-transactions" class="{{ Request::is('admin/transaksi/*') ? '' : 'hidden' }} py-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.transactions.stockin') }}" class="flex items-center w-full p-2 text-gray-900 dark:text-white transition duration-75 rounded-lg ps-11 group hover:bg-gray-100 dark:hover:bg-gray-700 {{ Request::is('admin/transaksi/masuk') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">Barang Masuk</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.transactions.stockout') }}" class="flex items-center w-full p-2 text-gray-900 dark:text-white transition duration-75 rounded-lg ps-11 group hover:bg-gray-100 dark:hover:bg-gray-700 {{ Request::is('admin/transaksi/keluar') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">Barang Keluar</a>
                    </li>
                </ul>
            </li>

            {{-- 3. Menu Manajemen Data Master --}}
            <li>
                <a href="{{ route('admin.products.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-indigo-500 dark:hover:bg-indigo-600 hover:text-white dark:hover:text-white group transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 {{ Request::is('admin/produk') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-6 text-center text-gray-500 fa-solid fa-box-archive transition duration-75 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-indigo-500 dark:hover:bg-indigo-600 hover:text-white dark:hover:text-white group transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 {{ Request::is('admin/kategori') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-6 text-center text-gray-500 fa-solid fa-tags transition duration-75 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Kategori</span>
                </a>
            </li>
             <li>
                <a href="{{ route('admin.suppliers.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-indigo-500 dark:hover:bg-indigo-600 hover:text-white dark:hover:text-white group transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 {{ Request::is('admin/supplier') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                   <i class="w-6 text-center text-gray-500 fa-solid fa-truck-fast transition duration-75 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white"></i>
                   <span class="flex-1 ml-3 whitespace-nowrap">Supplier</span>
                </a>
             </li>
             <li>
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-indigo-500 dark:hover:bg-indigo-600 hover:text-white dark:hover:text-white group transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 {{ Request::is('admin/pengguna') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                      <i class="w-6 text-center text-gray-500 fa-solid fa-users transition duration-75 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white"></i>
                      <span class="flex-1 ml-3 whitespace-nowrap">Pengguna</span>
                  </a>
             </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-indigo-500 dark:hover:bg-indigo-600 hover:text-white dark:hover:text-white group transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110">
                   <i class="w-6 text-center text-gray-500 fa-solid fa-file-lines transition duration-75 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white"></i>
                   <span class="flex-1 ml-3 whitespace-nowrap">Laporan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>