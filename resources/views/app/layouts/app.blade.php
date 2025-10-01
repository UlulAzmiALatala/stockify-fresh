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

    {{-- KONTEN UTAMA YANG MENGATUR STICKY FOOTER --}}
    <main class="sm:ml-64 flex flex-col min-h-screen">
        
        {{-- 1. Wrapper Konten yang akan "tumbuh" --}}
        <div class="flex-grow">
            {{-- 2. Spacer untuk navbar yang fixed (h-16 = 4rem) --}}
            <div class="pt-16">
                 @yield('content')
            </div>
        </div>

        {{-- 3. Footer akan terdorong ke bawah oleh div di atasnya --}}
        @include('app.components.footer')

    </main>

    {{-- Tempat untuk script tambahan dari halaman lain --}}
    @stack('scripts')
</body>

</html>

