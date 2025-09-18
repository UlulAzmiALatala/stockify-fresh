<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    {{-- Ini adalah Navbar (header atas) --}}
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="#" class="flex ml-2 md:mr-24">
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            
            {{-- 2. Menu Dropdown Transaksi --}}
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-transactions" data-collapse-toggle="dropdown-transactions">
                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path></svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Transaksi</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <ul id="dropdown-transactions" class="hidden py-2 space-y-2">
                      <li>
                         <a href="{{ route('admin.transactions.stockin') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Barang Masuk</a>
                      </li>
                      <li>
                         <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Barang Keluar</a>
                      </li>
                </ul>
            </li>

            {{-- 3. Menu Manajemen Data Master --}}
            <li>
                <a href="{{ route('admin.products.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v10H5V5z"></path></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M18.25 10.25a.75.75 0 00-1.5 0v5.5a.75.75 0 01-.75.75H4a.75.75 0 01-.75-.75v-5.5a.75.75 0 00-1.5 0v5.5A2.25 2.25 0 004 18h12a2.25 2.25 0 002.25-2.25v-5.5z"></path><path d="M10 2a.75.75 0 01.75.75v10.19l2.47-2.47a.75.75 0 111.06 1.06l-3.75 3.75a.75.75 0 01-1.06 0L5.72 11.53a.75.75 0 111.06-1.06l2.47 2.47V2.75A.75.75 0 0110 2z"></path></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Kategori</span>
                </a>
            </li>
             <li>
                <a href="{{ route('admin.suppliers.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                   <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M10.25 1.75a.75.75 0 00-1.5 0v1.25a.75.75 0 001.5 0V1.75zM8.75 3.25a.75.75 0 000 1.5h2.5a.75.75 0 000-1.5h-2.5zM12 6.5a.5.5 0 01.5.5v2.5a.5.5 0 01-1 0V7a.5.5 0 01.5-.5zM8 6.5a.5.5 0 01.5.5v2.5a.5.5 0 01-1 0V7a.5.5 0 01.5-.5zM5 11a1 1 0 11-2 0 1 1 0 012 0zm12 0a1 1 0 11-2 0 1 1 0 012 0zM2 13.25a.75.75 0 000 1.5h.521a2.75 2.75 0 015.457 0h4.044a2.75 2.75 0 015.457 0H18a.75.75 0 000-1.5h-.521a2.75 2.75 0 01-5.457 0H7.979a2.75 2.75 0 01-5.457 0H2zM4.75 16a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5zm10.5 0a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z"></path></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Supplier</span>
                </a>
            </li>
             <li>
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M7 8a3 3 0 116 0 3 3 0 01-6 0zM5 8a5 5 0 1110 0A5 5 0 015 8z"></path><path d="M16.5 15.5a.75.75 0 00-1.5 0v.5a2.5 2.5 0 01-2.5 2.5h-5A2.5 2.5 0 015 16v-.5a.75.75 0 00-1.5 0v.5A4 4 0 007.5 20h5a4 4 0 004-4v-.5z"></path></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Pengguna</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                   <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M15 3.75A2.25 2.25 0 0012.75 6H7.25A2.25 2.25 0 005 3.75V2.25a.75.75 0 00-1.5 0V3.75A3.75 3.75 0 007.25 7.5h5.5A3.75 3.75 0 0016.5 3.75V2.25a.75.75 0 00-1.5 0V3.75z"></path><path d="M3.5 8.75A.75.75 0 002.75 8h-1.5a.75.75 0 000 1.5h1.5a.75.75 0 00.75-.75zM17.25 8a.75.75 0 00-.75.75h1.5a.75.75 0 000-1.5h-1.5a.75.75 0 00-.75.75zM12 17.25a.75.75 0 01-.75-.75V11.25a.75.75 0 011.5 0v5.25a.75.75 0 01-.75.75zM8.25 17.25a.75.75 0 01-.75-.75V14.25a.75.75 0 011.5 0v2.25a.75.75 0 01-.75.75zM4.5 17.25a.75.75 0 01-.75-.75v-2a.75.75 0 011.5 0v2a.75.75 0 01-.75.75zM15.75 17.25a.75.75 0 01-.75-.75v-5a.75.75 0 011.5 0v5a.75.75 0 01-.75.75z"></path></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Laporan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>