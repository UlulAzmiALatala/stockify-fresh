@extends('app.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="p-4 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Admin Dashboard</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Ringkasan data dan aktivitas terkini dalam sistem.</p>
        </div>

        {{-- Kartu Statistik --}}
        <div class="grid grid-cols-1 gap-6 py-6 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Total Produk --}}
            <div class="p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-primary-100 dark:bg-primary-900/50 p-3 rounded-full">
                        <i class="fa-solid fa-box-archive w-6 h-6 text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">Total Produk</dt>
                            <dd><div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalProducts ?? 0 }}</div></dd>
                        </dl>
                    </div>
                </div>
            </div>
            {{-- Total Supplier --}}
            <div class="p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                 <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 dark:bg-green-900/50 p-3 rounded-full">
                        <i class="fa-solid fa-truck-fast w-6 h-6 text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">Total Supplier</dt>
                            <dd><div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalSuppliers ?? 0 }}</div></dd>
                        </dl>
                    </div>
                </div>
            </div>
             {{-- Barang Masuk Hari Ini --}}
            <div class="p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                 <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900/50 p-3 rounded-full">
                         <i class="fa-solid fa-circle-arrow-down w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">Barang Masuk Hari Ini</dt>
                            <dd><div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $transactionInToday ?? 0 }}</div></dd>
                        </dl>
                    </div>
                </div>
            </div>
             {{-- Barang Keluar Hari Ini --}}
            <div class="p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                 <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-100 dark:bg-yellow-900/50 p-3 rounded-full">
                         <i class="fa-solid fa-circle-arrow-up w-6 h-6 text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">Barang Keluar Hari Ini</dt>
                            <dd><div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $transactionOutToday ?? 0 }}</div></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Grafik Stok Barang --}}
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Grafik Stok 10 Produk Teratas</h3>
                <div>
                    <canvas id="productStockChart"></canvas>
                </div>
            </div>

            {{-- Pengguna Terbaru --}}
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <h3 class="text-lg font-semibold p-5 text-gray-700 dark:text-white border-b dark:border-gray-700">Pengguna Terbaru</h3>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($latestUsers as $user)
                        <div class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                            </div>
                            <span class="text-xs font-medium px-2 py-1 rounded-full bg-primary-100 text-primary-800 dark:bg-primary-900/50 dark:text-primary-300">{{ $user->getRoleNames()->first() }}</span>
                        </div>
                    @empty
                        <div class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            Belum ada pengguna lain yang terdaftar.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Memuat library Chart.js dari CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil data yang dikirim dari controller
        const productNames = @json($productNames ?? []);
        const productQuantities = @json($productQuantities ?? []);
        const isDarkMode = document.documentElement.classList.contains('dark');

        // Opsi warna untuk mode terang dan gelap
        const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
        const labelColor = isDarkMode ? '#9ca3af' : '#4b5563';

        if (document.getElementById('productStockChart')) {
            const ctx = document.getElementById('productStockChart').getContext('2d');
            const productStockChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: productNames,
                    datasets: [{
                        label: 'Jumlah Stok',
                        data: productQuantities,
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                color: labelColor // Warna label sumbu Y
                            },
                             grid: {
                                color: gridColor // Warna garis grid sumbu Y
                            }
                        },
                        x: {
                             ticks: {
                                color: labelColor // Warna label sumbu X
                            },
                            grid: {
                                color: gridColor // Warna garis grid sumbu X
                            }
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: labelColor // Warna label legenda
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush

