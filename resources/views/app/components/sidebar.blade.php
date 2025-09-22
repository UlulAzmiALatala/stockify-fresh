<aside id="logo-sidebar" 
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full 
           bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" 
    aria-label="Sidebar">

    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            {{-- 1. Menu Dashboard --}}
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white
                          transition duration-300 ease-in-out
                          hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500
                          {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 fa-solid fa-chart-pie"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            {{-- 2. Menu Dropdown Transaksi --}}
            <li>
                <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg dark:text-white
                               transition-colors duration-300 ease-in-out
                               hover:bg-indigo-500"
                        aria-controls="dropdown-transactions" data-collapse-toggle="dropdown-transactions">
                    <i class="w-5 h-5 fa-solid fa-arrow-right-arrow-left"></i>
                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Transaksi</span>
                    <i class="w-3 h-3 fa-solid fa-chevron-down transition-transform duration-300 group-[aria-expanded=true]:rotate-180"></i>
                </button>
                <ul id="dropdown-transactions" 
                    class="{{ request()->routeIs('stock.*') ? '' : 'hidden' }} py-2 space-y-2">
                    <li>
                        <a href="{{ route('stock.in.create') }}"
                           class="flex items-center w-full p-2 pl-11 text-gray-900 rounded-lg dark:text-white
                                  transition duration-300 ease-in-out
                                  hover:scale-105 hover:bg-indigo-500
                                  {{ request()->routeIs('stock.in.create') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            Barang Masuk
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('stock.out.create') }}"
                           class="flex items-center w-full p-2 pl-11 text-gray-900 rounded-lg dark:text-white
                                  transition duration-300 ease-in-out
                                  hover:scale-105 hover:bg-indigo-500
                                  {{ request()->routeIs('stock.out.create') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            Barang Keluar
                        </a>
                    </li>
                </ul>
            </li>

            {{-- 3. Menu Master Data --}}
            <li>
                <a href="{{ route('products.index') }}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white
                          transition duration-300 ease-in-out
                          hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500
                          {{ request()->routeIs('products.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 fa-solid fa-box-archive"></i>
                    <span class="ms-3">Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white
                          transition duration-300 ease-in-out
                          hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500
                          {{ request()->routeIs('categories.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 fa-solid fa-tags"></i>
                    <span class="ms-3">Kategori</span>
                </a>
            </li>
            <li>
                <a href="{{ route('suppliers.index') }}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white
                          transition duration-300 ease-in-out
                          hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500
                          {{ request()->routeIs('suppliers.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 fa-solid fa-truck-fast"></i>
                    <span class="ms-3">Supplier</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white
                          transition duration-300 ease-in-out
                          hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500
                          {{ request()->routeIs('users.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 fa-solid fa-users"></i>
                    <span class="ms-3">Pengguna</span>
                </a>
            </li>

            {{-- 4. Menu Dropdown Laporan --}}
            <li>
                <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg dark:text-white
                               transition-colors duration-300 ease-in-out
                               hover:bg-indigo-500"
                        aria-controls="dropdown-reports" data-collapse-toggle="dropdown-reports">
                    <i class="w-5 h-5 fa-solid fa-file-lines"></i>
                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Laporan</span>
                    <i class="w-3 h-3 fa-solid fa-chevron-down transition-transform duration-300 group-[aria-expanded=true]:rotate-180"></i>
                </button>
                <ul id="dropdown-reports" 
                    class="{{ request()->routeIs('reports.*') ? '' : 'hidden' }} py-2 space-y-2">
                    <li>
                        <a href="{{ route('reports.stock_status') }}"
                           class="flex items-center w-full p-2 pl-11 text-gray-900 rounded-lg dark:text-white
                                  transition duration-300 ease-in-out
                                  hover:scale-105 hover:bg-indigo-500
                                  {{ request()->routeIs('reports.stock_status') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            Laporan Stok
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reports.transactions') }}"
                           class="flex items-center w-full p-2 pl-11 text-gray-900 rounded-lg dark:text-white
                                  transition duration-300 ease-in-out
                                  hover:scale-105 hover:bg-indigo-500
                                  {{ request()->routeIs('reports.transactions') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            Riwayat Transaksi
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
