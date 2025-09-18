<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Stockify</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Memuat CSS dan JS utama dari Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">

    {{-- Memanggil komponen Navbar --}}
    @include('app.components.navbar')

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        
        {{-- Memanggil komponen Sidebar --}}
        @include('app.components.sidebar')

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                {{-- Di sinilah konten utama dari setiap halaman akan ditampilkan --}}
                @yield('content')
            </main>
            
            {{-- Memanggil komponen Footer --}}
            @include('app.components.footer')
        </div>

    </div>

    {{-- Tempat untuk script tambahan dari halaman lain --}}
    @stack('scripts')
</body>
</html>