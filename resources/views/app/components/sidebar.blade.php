<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            {{-- 1. MENU DASHBOARD (Bisa dilihat semua role) --}}
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-chart-pie"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            {{-- 2. MENU TRANSAKSI (Tampilan berbeda untuk setiap role) --}}
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-transactions" data-collapse-toggle="dropdown-transactions">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-arrow-right-arrow-left"></i>
                    <span class="flex-1 ms-3 text-left">Stok</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-transactions" class="py-2 space-y-2 {{ request()->routeIs('stock.*','transactions.*') ? '' : 'hidden' }}">
                    {{-- Link untuk Admin & Manajer --}}
                    @hasanyrole('admin|manager')
                        <li><a href="{{ route('stock.in.create') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Barang Masuk</a></li>
                        <li><a href="{{ route('stock.out.create') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Barang Keluar</a></li>
                    @endhasanyrole

                    {{-- Link Khusus untuk Staff Gudang --}}
                    @role('staff')
                         <li><a href="#" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Konfirmasi Penerimaan</a></li>
                         <li><a href="#" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Konfirmasi Pengeluaran</a></li>
                    @endrole
                </ul>
            </li>

            {{-- 3. MENU MANAJEMEN DATA (Hanya Admin & Manajer) --}}
            @hasanyrole('admin|manager')
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-data" data-collapse-toggle="dropdown-data">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-database"></i>
                    <span class="flex-1 ms-3 text-left">Manajemen Data</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-data" class="py-2 space-y-2 {{ request()->routeIs('products.*','categories.*','suppliers.*','users.*') ? '' : 'hidden' }}">
                    <li><a href="{{ route('products.index') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Produk</a></li>
                    <li><a href="{{ route('suppliers.index') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Supplier</a></li>
                    {{-- Kategori & Pengguna hanya untuk Admin --}}
                    @role('admin')
                        <li><a href="{{ route('categories.index') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Kategori</a></li>
                        <li><a href="{{ route('users.index') }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Pengguna</a></li>
                    @endrole
                </ul>
            </li>
            @endhasanyrole

            {{-- 4. MENU LAPORAN (Hanya Admin & Manajer) --}}
            @hasanyrole('admin|manager')
            <li>
                <a href="{{ route('reports.transactions') }}" 
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('reports.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-file-lines"></i>
                    <span class="ms-3">Laporan</span>
                </a>
            </li>
            @endhasanyrole
            
            {{-- 5. MENU PENGATURAN (Hanya Admin) --}}
            @role('admin')
            <li>
                <a href="#" {{-- Arahkan ke route settings nanti --}}
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="w-5 h-5 text-center text-gray-500 fa-solid fa-gear"></i>
                    <span class="ms-3">Pengaturan</span>
                </a>
            </li>
            @endrole
        </ul>
    </div>
</aside>