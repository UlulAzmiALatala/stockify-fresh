<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            {{-- 1. MENU DASHBOARD --}}
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-chart-pie dark:text-gray-400"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            {{-- 2. MENU TRANSAKSI (HANYA MANAJER & STAF) --}}
            @hasanyrole('manager|staff')
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-transactions" data-collapse-toggle="dropdown-transactions">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-arrow-right-arrow-left dark:text-gray-400"></i>
                    <span class="flex-1 ms-3 text-left">Transaksi</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-transactions" class="py-2 space-y-2 {{ request()->routeIs(['stock.in.create', 'stock.out.create', 'staff.stock.confirm-in', 'staff.stock.prepare-out']) ? '' : 'hidden' }}">
                    @role('manager')
                        <li><a href="{{ route('stock.in.create') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Barang Masuk</a></li>
                        <li><a href="{{ route('stock.out.create') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Barang Keluar</a></li>
                    @endrole
                    @role('staff')
                        <li><a href="{{ route('staff.stock.confirm-in') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Konfirmasi Penerimaan</a></li>
                        <li><a href="{{ route('staff.stock.prepare-out') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Siapkan Pengeluaran</a></li>
                    @endrole
                </ul>
            </li>
            @endhasanyrole

            {{-- 3. MENU STOK (HANYA MANAJER) --}}
            @role('manager')
             <li>
                <a href="{{ route('manager.stock.opname') }}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('manager.stock.opname') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                   <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-boxes-stacked dark:text-gray-400"></i>
                   <span class="ms-3">Stock Opname</span>
                </a>
            </li>
            @endrole

            {{-- 4. MENU MASTER DATA (HANYA ADMIN) --}}
            @role('admin')
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-data" data-collapse-toggle="dropdown-data">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-database dark:text-gray-400"></i>
                    <span class="flex-1 ms-3 text-left">Master Data</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-data" class="py-2 space-y-2 {{ request()->routeIs(['products.*','categories.*','suppliers.*','attributes.*', 'users.*']) ? '' : 'hidden' }}">
                    <li><a href="{{ route('products.index') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Produk</a></li>
                    <li><a href="{{ route('categories.index') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Kategori</a></li>
                    <li><a href="{{ route('suppliers.index') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Supplier</a></li>
                    <li><a href="{{ route('attributes.index') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Atribut</a></li>
                    <li><a href="{{ route('users.index') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Pengguna</a></li>
                </ul>
            </li>
            @endrole

            {{-- 5. MENU LAPORAN (ADMIN & MANAJER) --}}
            @hasanyrole('admin|manager')
            <li>
                 <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-reports" data-collapse-toggle="dropdown-reports">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-file-lines dark:text-gray-400"></i>
                    <span class="flex-1 ms-3 text-left">Laporan</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                 <ul id="dropdown-reports" class="py-2 space-y-2 {{ request()->routeIs(['transactions.index', 'admin.stock.report', 'admin.reports.activity-log']) ? '' : 'hidden' }}">
                    @role('admin')
                        <li><a href="{{ route('admin.stock.report') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Laporan Stok</a></li>
                    @endrole
                    <li><a href="{{ route('transactions.index') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Riwayat Transaksi</a></li>
                    @role('admin')
                        <li><a href="{{ route('admin.reports.activity-log') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Aktivitas Pengguna</a></li>
                    @endrole
                </ul>
            </li>
            @endhasanyrole
            
            {{-- 6. MENU PENGATURAN (ADMIN) --}}
            @role('admin')
            <li>
                <a href="{{ route('settings.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('settings.index') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-gear dark:text-gray-400"></i>
                    <span class="ms-3">Pengaturan</span>
                </a>
            </li>
            @endrole
        </ul>
    </div>
</aside>

