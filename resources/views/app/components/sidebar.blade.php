<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            {{-- MENU UTAMA --}}
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i
                        class="fa-solid fa-chart-pie w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            @hasanyrole('admin|manager')
                {{-- MENU TRANSAKSI (Admin & Manajer Gudang) --}}
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
                        aria-controls="dropdown-transactions" data-collapse-toggle="dropdown-transactions">
                        <i
                            class="fa-solid fa-arrow-right-arrow-left w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Transaksi</span>
                        <i class="fa-solid fa-chevron-down w-3 h-3"></i>
                    </button>
                    <ul id="dropdown-transactions" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('stock.in.create') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Barang
                                Masuk</a>
                        </li>
                        <li>
                            <a href="{{ route('stock.out.create') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Barang
                                Keluar</a>
                        </li>
                        <li>
                            <a href="{{ route('transactions.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Riwayat</a>
                        </li>
                    </ul>
                </li>
            @endhasanyrole

            @hasanyrole('staff')
                {{-- MENU TUGAS (Staff Gudang) --}}
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fa-solid fa-clipboard-check w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3">Konfirmasi Barang Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fa-solid fa-boxes-packing w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ms-3">Siapkan Barang Keluar</span>
                    </a>
                </li>
            @endhasanyrole

            @hasanyrole('admin|manager')
                {{-- MENU LAPORAN (Admin & Manajer Gudang) --}}
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
                        aria-controls="dropdown-reports" data-collapse-toggle="dropdown-reports">
                        <i
                            class="fa-solid fa-file-lines w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Laporan</span>
                        <i class="fa-solid fa-chevron-down w-3 h-3"></i>
                    </button>
                    <ul id="dropdown-reports" class="hidden py-2 space-y-2">
                        <li>
                            {{-- PERBAIKAN: Menggunakan nama rute yang benar --}}
                            <a href="{{ route('reports.stock_status') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Laporan
                                Stok</a>
                        </li>
                        <li>
                            <a href="{{ route('reports.transactions') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Riwayat
                                Transaksi</a>
                        </li>
                    </ul>
                </li>
            @endhasanyrole

            @hasanyrole('admin')
                {{-- PENGATURAN & MASTER DATA (Hanya Admin) --}}
                <li class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg group dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
                        aria-controls="dropdown-master-data" data-collapse-toggle="dropdown-master-data">
                        <i
                            class="fa-solid fa-database w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Master Data</span>
                        <i class="fa-solid fa-chevron-down w-3 h-3"></i>
                    </button>
                    <ul id="dropdown-master-data" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('products.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Produk</a>
                        </li>
                        <li>
                            <a href="{{ route('categories.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Kategori</a>
                        </li>
                        <li>
                            <a href="{{ route('suppliers.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Supplier</a>
                        </li>
                        <li>
                            <a href="{{ route('attributes.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Atribut</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fa-solid fa-users-cog w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Manajemen Pengguna</span>
                    </a>
                </li>
            @endhasanyrole

        </ul>
    </div>
</aside>

