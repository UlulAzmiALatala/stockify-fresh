<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-16 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            {{-- Definisikan kelas untuk status aktif agar mudah dibaca --}}
            @php
                $activeClass = 'bg-primary-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400 font-bold';
                $inactiveClass = 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary-600 dark:hover:text-primary-400';
            @endphp

            {{-- 1. MENU DASHBOARD --}}
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center p-2 rounded-lg group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('dashboard') ? $activeClass : $inactiveClass }}">
                    <i class="w-5 h-5 text-center {{ request()->routeIs('dashboard') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400' }} fa-solid fa-chart-pie transition duration-200 ease-in-out"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            {{-- 2. MENU MANAJEMEN PRODUK (Bisa diakses Admin & Manager) --}}
            @hasanyrole('admin|manager')
            @php
                // Logika untuk menentukan apakah menu induk 'Manajemen Produk' sedang aktif
                $isProductMenuActive = request()->routeIs(['products.*', 'categories.*', 'admin.suppliers.*', 'manager.suppliers.*', 'attributes.*']);
            @endphp
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base rounded-lg group transition duration-200 ease-in-out hover:translate-x-2 {{ $inactiveClass }} {{ $isProductMenuActive ? 'text-primary-600 dark:text-primary-400' : '' }}" aria-controls="dropdown-products" data-collapse-toggle="dropdown-products">
                    <i class="w-5 h-5 text-center {{ $isProductMenuActive ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400' }} fa-solid fa-box-archive transition duration-200 ease-in-out"></i>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Manajemen Produk</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-products" class="py-2 space-y-2 {{ $isProductMenuActive ? '' : 'hidden' }}">
                    {{-- 'Daftar Produk' bisa dilihat oleh admin & manager --}}
                    <li>
                        <a href="{{ route('products.index') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('products.*') ? $activeClass : $inactiveClass }}">Daftar Produk</a>
                    </li>
                    
                    {{-- Hanya 'admin' yang bisa melihat Kategori --}}
                    @role('admin')
                    <li>
                        <a href="{{ route('categories.index') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('categories.*') ? $activeClass : $inactiveClass }}">Kategori</a>
                    </li>
                    @endrole

                    {{-- Link 'Supplier' yang berbeda untuk Admin dan Manager --}}
                    <li>
                        @role('admin')
                            {{-- Link ini hanya untuk ADMIN --}}
                            <a href="{{ route('admin.suppliers.index') }}" 
                               class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('admin.suppliers.*') ? $activeClass : $inactiveClass }}">
                               Supplier
                            </a>
                        @else
                            {{-- Link ini hanya untuk MANAGER --}}
                            <a href="{{ route('manager.suppliers.index') }}" 
                               class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('manager.suppliers.*') ? $activeClass : $inactiveClass }}">
                               Supplier
                            </a>
                        @endrole
                    </li>
                    
                    {{-- Hanya 'admin' yang bisa melihat Atribut --}}
                    @role('admin')
                    <li>
                        <a href="{{ route('attributes.index') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('attributes.*') ? $activeClass : $inactiveClass }}">Atribut</a>
                    </li>
                    @endrole
                </ul>
            </li>
            @endhasanyrole
            
            {{-- 3. MENU MANAJEMEN STOK (Tampilan berbeda untuk tiap role) --}}
            @php
                $isStockMenuActive = request()->routeIs(['stock.in.create', 'stock.out.create', 'manager.stock.opname', 'staff.stock.confirm-in', 'staff.stock.prepare-out', 'admin.stock.report']);
            @endphp
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base rounded-lg group transition duration-200 ease-in-out hover:translate-x-2 {{ $inactiveClass }} {{ $isStockMenuActive ? 'text-primary-600 dark:text-primary-400' : '' }}" aria-controls="dropdown-stock" data-collapse-toggle="dropdown-stock">
                    <i class="w-5 h-5 text-center {{ $isStockMenuActive ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400' }} fa-solid fa-boxes-stacked transition duration-200 ease-in-out"></i>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Manajemen Stok</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-stock" class="py-2 space-y-2 {{ $isStockMenuActive ? '' : 'hidden' }}">
                    @role('admin')
                        <li><a href="{{ route('admin.stock.report') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('admin.stock.report') ? $activeClass : $inactiveClass }}">Laporan Stok</a></li>
                    @endrole
                    @role('manager')
                        <li><a href="{{ route('stock.in.create') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('stock.in.create') ? $activeClass : $inactiveClass }}">Catat Barang Masuk</a></li>
                        <li><a href="{{ route('stock.out.create') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('stock.out.create') ? $activeClass : $inactiveClass }}">Catat Barang Keluar</a></li>
                        <li><a href="{{ route('manager.stock.opname') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('manager.stock.opname') ? $activeClass : $inactiveClass }}">Stock Opname</a></li>
                    @endrole
                    @role('staff')
                        <li><a href="{{ route('staff.stock.confirm-in') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('staff.stock.confirm-in') ? $activeClass : $inactiveClass }}">Konfirmasi Masuk</a></li>
                        <li><a href="{{ route('staff.stock.prepare-out') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('staff.stock.prepare-out') ? $activeClass : $inactiveClass }}">Siapkan Keluar</a></li>
                    @endrole
                </ul>
            </li>

            {{-- 4. MENU LAPORAN (Bisa diakses Admin & Manager) --}}
            @hasanyrole('admin|manager')
            @php
                $isReportActive = request()->routeIs(['transactions.index', 'admin.reports.activity-log']);
            @endphp
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base rounded-lg group transition duration-200 ease-in-out hover:translate-x-2 {{ $inactiveClass }} {{ $isReportActive ? 'text-primary-600 dark:text-primary-400' : '' }}" aria-controls="dropdown-reports" data-collapse-toggle="dropdown-reports">
                    <i class="w-5 h-5 text-center {{ $isReportActive ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400' }} fa-solid fa-file-lines transition duration-200 ease-in-out"></i>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Laporan</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-reports" class="py-2 space-y-2 {{ $isReportActive ? '' : 'hidden' }}">
                    <li><a href="{{ route('transactions.index') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('transactions.index') ? $activeClass : $inactiveClass }}">Riwayat Transaksi</a></li>
                    @role('admin')
                        <li><a href="{{ route('admin.reports.activity-log') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('admin.reports.activity-log') ? $activeClass : $inactiveClass }}">Aktivitas Pengguna</a></li>
                    @endrole
                </ul>
            </li>
            @endhasanyrole

            {{-- 5. MENU MANAJEMEN PENGGUNA (Hanya Admin) --}}
            @role('admin')
            <li>
                <a href="{{ route('users.index') }}" 
                   class="flex items-center p-2 rounded-lg group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('users.*') ? $activeClass : $inactiveClass }}">
                    <i class="w-5 h-5 text-center {{ request()->routeIs('users.*') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400' }} fa-solid fa-users transition duration-200 ease-in-out"></i>
                    <span class="ms-3">Manajemen Pengguna</span>
                </a>
            </li>
            @endrole
            
            {{-- 6. MENU PENGATURAN (Hanya Admin) --}}
            @role('admin')
            <li>
                <a href="{{ route('settings.index') }}" 
                   class="flex items-center p-2 rounded-lg group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('settings.index') ? $activeClass : $inactiveClass }}">
                    <i class="w-5 h-5 text-center {{ request()->routeIs('settings.index') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400' }} fa-solid fa-gear transition duration-200 ease-in-out"></i>
                    <span class="ms-3">Pengaturan</span>
                </a>
            </li>
            @endrole
        </ul>
    </div>
</aside>