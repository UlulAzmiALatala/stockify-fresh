<!DOCTYPE html>
<<<<<<< HEAD
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Stockify Dashboard')</title>
=======
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Stockify</title>
>>>>>>> da41e890a093ccbc1418683b9afa6593e76603c5

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Memuat CSS dan JS utama dari Vite --}}
<<<<<<< HEAD
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    
    {{-- Di sini kita akan memanggil komponen sidebar dan navbar dari template Anda --}}
    {{-- Asumsi nama komponennya adalah 'sidebar' dan 'navbar' --}}
    {{-- <x-sidebar /> --}}
    {{-- <x-navbar /> --}}

    {{-- Konten Utama --}}
    <main>
        {{-- Jika Anda menggunakan sidebar, tambahkan class 'sm:ml-64' di div ini --}}
        <div class="p-4"> 
            <div class="mt-14">
                {{-- Di sini konten dari setiap halaman (seperti users/index) akan dimuat --}}
                @yield('content')
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    {{-- Tempat untuk script tambahan dari halaman lain (seperti script fetch kita) --}}
=======
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
>>>>>>> da41e890a093ccbc1418683b9afa6593e76603c5
    @stack('scripts')
</body>
</html>