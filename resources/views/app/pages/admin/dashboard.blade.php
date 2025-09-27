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
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Grafik Stok 10 Produk Teratas</h3>
                <div class="relative h-96">
                    <canvas id="productStockChart"></canvas>
                </div>
            </div>

            {{-- Pengguna Terbaru --}}
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <h3 class="text-lg font-semibold p-5 text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700">Pengguna Terbaru</h3>
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
    // Pindahkan variabel chart ke scope global agar bisa diakses dan diperbarui
    let productStockChart;

    // Buat fungsi khusus untuk menggambar/memperbarui grafik. Logika di dalamnya sudah benar.
    function renderOrUpdateChart() {
        const canvas = document.getElementById('productStockChart');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        const productNames = @json($productNames ?? []);
        const productQuantities = @json($productQuantities ?? []);

        const pieColors = [
            'rgba(255, 99, 132, 0.9)', 'rgba(54, 162, 235, 0.9)', 'rgba(255, 206, 86, 0.9)',
            'rgba(75, 192, 192, 0.9)', 'rgba(153, 102, 255, 0.9)', 'rgba(255, 159, 64, 0.9)',
            'rgba(46, 204, 113, 0.9)', 'rgba(52, 152, 219, 0.9)', 'rgba(241, 196, 15, 0.9)',
            'rgba(231, 76, 60, 0.9)'
        ];

        const isDarkMode = document.documentElement.classList.contains('dark');
        const legendTextColor = isDarkMode ? '#f9fafb' : '#374151';
        const pieBorderColor = isDarkMode ? '#1f2937' : '#ffffff';

        if (productStockChart) {
            productStockChart.destroy();
        }

        productStockChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: productNames,
                datasets: [{
                    label: 'Jumlah Stok',
                    data: productQuantities,
                    backgroundColor: pieColors,
                    borderColor: pieBorderColor,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: legendTextColor,
                            font: { size: 14 }
                        }
                    },
                    tooltip: {
                        titleColor: legendTextColor,
                        bodyColor: legendTextColor,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.chart.getDatasetMeta(0).total;
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) + '%' : '0%';
                                return ` ${label}: ${value} (${percentage})`;
                            }
                        }
                    }
                }
            }
        });
    }

    // --- START: PERBAIKAN DENGAN MUTATION OBSERVER ---

    // 1. Gambar grafik saat halaman pertama kali dimuat
    document.addEventListener('DOMContentLoaded', renderOrUpdateChart);

    // 2. Buat "penjaga" (Observer) untuk mengawasi perubahan tema
    const themeObserver = new MutationObserver((mutationsList) => {
        for(const mutation of mutationsList) {
            // Kita hanya peduli jika atribut 'class' pada <html> yang berubah
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                // Panggil fungsi untuk menggambar ulang grafik
                renderOrUpdateChart();
            }
        }
    });

    // 3. Perintahkan "penjaga" untuk mulai mengawasi elemen <html>
    themeObserver.observe(document.documentElement, { attributes: true });
</script>
@endpush

