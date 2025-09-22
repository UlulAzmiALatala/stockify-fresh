<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            {{-- 1. Menu Dashboard --}}
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 text-gray-500 transition duration-75 fa-solid fa-chart-pie dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            {{-- 2. Menu Dropdown Transaksi --}}
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-transactions" data-collapse-toggle="dropdown-transactions">
                    <i class="w-5 h-5 text-gray-500 transition duration-75 fa-solid fa-arrow-right-arrow-left dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Transaksi</span>
                    <i class="w-3 h-3 fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-transactions" class="{{ request()->routeIs('stock.*') ? '' : 'hidden' }} py-2 space-y-2">
                    <li>
                        <a href="{{ route('stock.in.create') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('stock.in.create') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">Barang Masuk</a>
                    </li>
                    <li>
                        <a href="{{ route('stock.out.create') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('stock.out.create') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">Barang Keluar</a>
                    </li>
                </ul>
            </li>

            {{-- 3. Menu Manajemen Data Master --}}
            <li>
                <a href="{{ route('products.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('products.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 text-gray-500 transition duration-75 fa-solid fa-box-archive dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('categories.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 text-gray-500 transition duration-75 fa-solid fa-tags dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Kategori</span>
                </a>
            </li>
             <li>
                <a href="{{ route('suppliers.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('suppliers.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                   <i class="w-5 h-5 text-gray-500 transition duration-75 fa-solid fa-truck-fast dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                   <span class="flex-1 ms-3 whitespace-nowrap">Supplier</span>
                </a>
             </li>
             <li>
                <a href="{{ route('users.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('users.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 text-gray-500 transition duration-75 fa-solid fa-users dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Pengguna</span>
                </a>
             </li>
            {{-- 4. Menu Dropdown Laporan --}}
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-reports" data-collapse-toggle="dropdown-reports">
                    <i class="w-5 h-5 text-gray-500 transition duration-75 fa-solid fa-file-lines dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Laporan</span>
                    <i class="w-3 h-3 fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-reports" class="{{ request()->routeIs('reports.*') ? '' : 'hidden' }} py-2 space-y-2">
                    <li>
                        <a href="{{ route('reports.stock_status') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('reports.stock_status') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">Laporan Stok</a>
                    </li>
                    <li>
                        <a href="{{ route('reports.transactions') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('reports.transactions') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">Riwayat Transaksi</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
