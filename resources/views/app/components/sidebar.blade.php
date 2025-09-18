<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    {{-- Ini adalah Navbar (header atas) --}}
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <i class="fa-solid fa-bars w-6 h-6"></i>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex ml-2 md:mr-24">
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Stockify</span>
                </a>
            </div>
            <div class="flex items-center">
                {{-- Dropdown Profil User bisa ditambahkan di sini nanti --}}
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    {{-- Ini adalah Sidebar (menu kiri) --}}
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            {{-- 1. Menu Dashboard --}}
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Request::is('admin/dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    {{-- DIUBAH: kelas h-6 dihapus untuk alignment otomatis --}}
                    <i class="w-6 text-center text-gray-500 fa-solid fa-chart-pie transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            
            {{-- 2. Menu Dropdown Transaksi --}}
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 {{ Request::is('admin/transaksi/*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}" aria-controls="dropdown-transactions" data-collapse-toggle="dropdown-transactions">
                    <i class="w-6 text-center text-gray-500 fa-solid fa-arrow-right-arrow-left transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Transaksi</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-transactions" class="{{ Request::is('admin/transaksi/*') ? '' : 'hidden' }} py-2 space-y-2">
                      <li>
                         <a href="{{ route('admin.transactions.stockin') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/transaksi/masuk') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">Barang Masuk</a>
                      </li>
                      <li>
                         <a href="{{ route('admin.transactions.stockout') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ Request::is('admin/transaksi/keluar') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">Barang Keluar</a>
                      </li>
                </ul>
            </li>

            {{-- 3. Menu Manajemen Data Master --}}
            <li>
                <a href="{{ route('admin.products.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Request::is('admin/produk') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-6 text-center text-gray-500 fa-solid fa-box-archive transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Request::is('admin/kategori') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-6 text-center text-gray-500 fa-solid fa-tags transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Kategori</span>
                </a>
            </li>
             <li>
                <a href="{{ route('admin.suppliers.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Request::is('admin/supplier') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                   <i class="w-6 text-center text-gray-500 fa-solid fa-truck-fast transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Supplier</span>
                </a>
            </li>
             <li>
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Request::is('admin/pengguna') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-6 text-center text-gray-500 fa-solid fa-users transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Pengguna</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                   <i class="w-6 text-center text-gray-500 fa-solid fa-file-lines transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Laporan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>