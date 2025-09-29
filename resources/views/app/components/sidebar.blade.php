<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
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
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-chart-pie dark:text-gray-400 transition duration-200 ease-in-out group-hover:text-primary-600 dark:group-hover:text-primary-400 {{ request()->routeIs('dashboard') ? 'text-primary-600 dark:text-primary-400' : '' }}"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            {{-- 2. MENU TRANSAKSI (Aksi Harian) --}}
            @hasanyrole('manager|staff')
            @php
                $isTransactionActive = request()->routeIs(['stock.in.create', 'stock.out.create', 'staff.stock.confirm-in', 'staff.stock.prepare-out']);
            @endphp
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base rounded-lg group transition duration-200 ease-in-out hover:translate-x-2 {{ $inactiveClass }} {{ $isTransactionActive ? 'text-primary-600 dark:text-primary-400' : '' }}" aria-controls="dropdown-transactions" data-collapse-toggle="dropdown-transactions">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-arrow-right-arrow-left dark:text-gray-400 transition duration-200 ease-in-out group-hover:text-primary-600 dark:group-hover:text-primary-400 {{ $isTransactionActive ? 'text-primary-600 dark:text-primary-400' : '' }}"></i>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Transaksi</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-transactions" class="py-2 space-y-2 {{ $isTransactionActive ? '' : 'hidden' }}">
                    @role('manager')
                        <li><a href="{{ route('stock.in.create') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('stock.in.create') ? $activeClass : $inactiveClass }}">Barang Masuk</a></li>
                        <li><a href="{{ route('stock.out.create') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('stock.out.create') ? $activeClass : $inactiveClass }}">Barang Keluar</a></li>
                    @endrole
                    @role('staff')
                        <li><a href="{{ route('staff.stock.confirm-in') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('staff.stock.confirm-in') ? $activeClass : $inactiveClass }}">Konfirmasi Penerimaan</a></li>
                        <li><a href="{{ route('staff.stock.prepare-out') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('staff.stock.prepare-out') ? $activeClass : $inactiveClass }}">Siapkan Pengeluaran</a></li>
                    @endrole
                </ul>
            </li>
            @endhasanyrole

            {{-- 3. MENU STOK (Penyesuaian & Laporan Stok) --}}
            @hasanyrole('admin|manager')
             @php
                $isStockActive = request()->routeIs(['admin.stock.report', 'manager.stock.opname']);
            @endphp
            <li>
                <a href="{{ Auth::user()->hasRole('admin') ? route('admin.stock.report') : route('manager.stock.opname') }}" 
                   class="flex items-center p-2 rounded-lg group transition duration-200 ease-in-out hover:translate-x-2 {{ $isStockActive ? $activeClass : $inactiveClass }}">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-boxes-stacked dark:text-gray-400 transition duration-200 ease-in-out group-hover:text-primary-600 dark:group-hover:text-primary-400 {{ $isStockActive ? 'text-primary-600 dark:text-primary-400' : '' }}"></i>
                    <span class="ms-3">{{ Auth::user()->hasRole('admin') ? 'Laporan Stok' : 'Stock Opname' }}</span>
                </a>
            </li>
            @endhasanyrole

            {{-- 4. MENU MASTER DATA (Hanya Admin) --}}
            @role('admin')
            @php
                $isMasterDataActive = request()->routeIs(['products.*','categories.*','suppliers.*','attributes.*', 'users.*']);
            @endphp
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base rounded-lg group transition duration-200 ease-in-out hover:translate-x-2 {{ $inactiveClass }} {{ $isMasterDataActive ? 'text-primary-600 dark:text-primary-400' : '' }}" aria-controls="dropdown-data" data-collapse-toggle="dropdown-data">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-database dark:text-gray-400 transition duration-200 ease-in-out group-hover:text-primary-600 dark:group-hover:text-primary-400 {{ $isMasterDataActive ? 'text-primary-600 dark:text-primary-400' : '' }}"></i>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Master Data</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-data" class="py-2 space-y-2 {{ $isMasterDataActive ? '' : 'hidden' }}">
                    <li><a href="{{ route('products.index') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('products.*') ? $activeClass : $inactiveClass }}">Produk</a></li>
                    <li><a href="{{ route('categories.index') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('categories.*') ? $activeClass : $inactiveClass }}">Kategori</a></li>
                    <li><a href="{{ route('suppliers.index') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('suppliers.*') ? $activeClass : $inactiveClass }}">Supplier</a></li>
                    <li><a href="{{ route('attributes.index') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('attributes.*') ? $activeClass : $inactiveClass }}">Atribut</a></li>
                    <li><a href="{{ route('users.index') }}" class="flex items-center w-full p-2 rounded-lg pl-11 group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('users.*') ? $activeClass : $inactiveClass }}">Pengguna</a></li>
                </ul>
            </li>
            @endrole

            {{-- 5. MENU LAPORAN (Hanya Admin & Manajer) --}}
            @hasanyrole('admin|manager')
             @php
                $isReportActive = request()->routeIs(['transactions.index', 'admin.reports.activity-log']);
            @endphp
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base rounded-lg group transition duration-200 ease-in-out hover:translate-x-2 {{ $inactiveClass }} {{ $isReportActive ? 'text-primary-600 dark:text-primary-400' : '' }}" aria-controls="dropdown-reports" data-collapse-toggle="dropdown-reports">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-file-lines dark:text-gray-400 transition duration-200 ease-in-out group-hover:text-primary-600 dark:group-hover:text-primary-400 {{ $isReportActive ? 'text-primary-600 dark:text-primary-400' : '' }}"></i>
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
            
            {{-- 6. MENU PENGATURAN (Hanya Admin) --}}
            @role('admin')
            <li>
                <a href="{{ route('settings.index') }}" 
                   class="flex items-center p-2 rounded-lg group transition duration-200 ease-in-out hover:translate-x-2 {{ request()->routeIs('settings.index') ? $activeClass : $inactiveClass }}">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-gear dark:text-gray-400 transition duration-200 ease-in-out group-hover:text-primary-600 dark:group-hover:text-primary-400 {{ request()->routeIs('settings.index') ? 'text-primary-600 dark:text-primary-400' : '' }}"></i>
                    <span class="ms-3">Pengaturan</span>
                </a>
            </li>
            @endrole
        </ul>
    </div>
</aside>

