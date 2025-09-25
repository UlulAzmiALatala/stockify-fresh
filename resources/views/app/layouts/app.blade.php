<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Stockify</title>

    {{-- Meta tag untuk keamanan form (PENTING UNTUK JAVASCRIPT) --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Memuat CSS dan JS utama dari Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

{{-- Jadikan body sebagai flex container vertikal setinggi layar --}}
<body class="bg-gray-50 dark:bg-gray-900 flex flex-col min-h-screen">

    {{-- Navbar dipanggil di sini --}}
    @include('app.components.navbar')

    {{-- ========================================================== --}}
    {{-- == PERBAIKAN: Kelas 'overflow-hidden' dihapus dari sini == --}}
    {{-- ========================================================== --}}
    <div class="flex flex-grow pt-16 bg-gray-50 dark:bg-gray-900">

        {{-- Sidebar dipanggil di sini --}}
        @include('app.components.sidebar')

        {{-- Jadikan area konten sebagai flex container vertikal juga --}}
        <div id="main-content"
            class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900 flex flex-col">

            {{-- Biarkan <main> tumbuh dan mendorong footer ke bawah --}}
            <main class="flex-grow">
                {{-- Konten dari setiap halaman akan muncul di sini --}}
                @yield('content')
            </main>

            {{-- Footer dipanggil di dalam area konten --}}
            @include('app.components.footer')
        </div>

    </div>

    {{-- Tempat untuk script tambahan dari halaman lain --}}
    @stack('scripts')
</body>

</html>
