<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">

    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            {{-- =================================================================== --}}
            {{-- MENU UNTUK SEMUA ROLE --}}
            {{-- =================================================================== --}}
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 fa-solid fa-chart-pie text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>


            {{-- =================================================================== --}}
            {{-- MENU KHUSUS ADMIN --}}
            {{-- =================================================================== --}}
            @role('admin')
                <li class="pt-4 pb-2 px-2 text-xs font-semibold text-gray-400 uppercase">
                    <span>Administrasi</span>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('categories.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="w-5 h-5 fa-solid fa-tags text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3">Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('suppliers.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('suppliers.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="w-5 h-5 fa-solid fa-truck-fast text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3">Supplier</span>
                    </a>
                </li>
                 <li>
                    <a href="{{ route('attributes.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('attributes.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="w-5 h-5 fa-solid fa-list-ol text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3">Atribut Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('users.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="w-5 h-5 fa-solid fa-users text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3">Pengguna</span>
                    </a>
                </li>
            @endrole


            {{-- =================================================================== --}}
            {{-- MENU KHUSUS MANAJER GUDANG --}}
            {{-- =================================================================== --}}
            @role('manager')
                <li class="pt-4 pb-2 px-2 text-xs font-semibold text-gray-400 uppercase">
                    <span>Manajemen Gudang</span>
                </li>
                <li>
                    <a href="{{ route('products.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('products.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="w-5 h-5 fa-solid fa-box-archive text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3">Produk</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-transactions" data-collapse-toggle="dropdown-transactions">
                        <i class="w-5 h-5 fa-solid fa-arrow-right-arrow-left text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Transaksi</span>
                        <i class="w-3 h-3 fa-solid fa-chevron-down"></i>
                    </button>
                    <ul id="dropdown-transactions" class="{{ request()->routeIs('transactions.create*') ? '' : 'hidden' }} py-2 space-y-2">
                        <li>
                            <a href="{{ route('transactions.createStockIn') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Barang
                                Masuk</a>
                        </li>
                        <li>
                            <a href="{{ route('transactions.createStockOut') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Barang
                                Keluar</a>
                        </li>
                    </ul>
                </li>
                 <li>
                    {{-- Ganti '#' dengan route yang sesuai nanti --}}
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="w-5 h-5 fa-solid fa-clipboard-check text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3">Stock Opname</span>
                    </a>
                </li>
            @endrole


            {{-- =================================================================== --}}
            {{-- MENU UNTUK ADMIN & MANAJER GUDANG --}}
            {{-- =================================================================== --}}
            @hasanyrole('admin|manager')
                 <li class="pt-4 pb-2 px-2 text-xs font-semibold text-gray-400 uppercase">
                    <span>Laporan & Riwayat</span>
                </li>
                <li>
                    <a href="{{ route('transactions.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('transactions.index') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="w-5 h-5 fa-solid fa-clock-rotate-left text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3">Riwayat Transaksi</span>
                    </a>
                </li>
                <li>
                     <a href="{{ route('reports.stockStatus') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('reports.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="w-5 h-5 fa-solid fa-file-lines text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3">Laporan Stok</span>
                    </a>
                </li>
            @endhasanyrole

        </ul>
    </div>
</aside>
