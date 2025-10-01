<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Stockify</title>

    {{-- Meta tag untuk keamanan form --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    {{-- PERBAIKAN: 'xintegrity' diubah menjadi 'integrity' --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Memuat CSS dan JS utama dari Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Favicon Links --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    @stack('styles')
</head>

<body class="bg-gray-50 dark:bg-gray-900">

    {{-- Navbar (fixed, di luar alur utama) --}}
    @include('app.components.navbar')

    {{-- Sidebar (fixed, di luar alur utama) --}}
    @include('app.components.sidebar')

    {{-- KONTEN UTAMA DENGAN PADDING UNTUK NAVBAR DAN FOOTER --}}
    <main class="sm:ml-64 pt-16 pb-16">
        {{-- Padding-bottom (pb-16) memberi ruang agar konten terakhir tidak tertutup footer --}}
        @yield('content')
    </main>
    
    {{-- FOOTER YANG FIXED DI BAWAH LAYAR --}}
    <div class="fixed bottom-0 left-0 right-0 z-30 sm:ml-64">
        {{-- Di sini kita ganti @include dengan kode footer yang sudah dimodifikasi --}}
        <footer class="py-3 bg-white md:py-4 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="container mx-auto text-center">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    © {{ date('Y') }} <a href="#" class="hover:underline">Stockify™</a>. All Rights Reserved.
                </span>
            </div>
        </footer>
    </div>

    {{-- Tempat untuk script tambahan dari halaman lain --}}
    @stack('scripts')
</body>

</html>

