@extends('app.layouts.app')

@section('title', 'Staff Dashboard')

@section('content')
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight text-gray-800">Staff Dashboard</h2>
                <p class="text-sm text-gray-600">Daftar tugas operasional gudang Anda.</p>
            </div>

            <!-- Kartu Tugas -->
            <div class="grid grid-cols-1 gap-6 py-6 sm:grid-cols-2 lg:grid-cols-3">

                <!-- Tugas: Konfirmasi Barang Masuk -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-blue-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" y1="15" x2="12" y2="3" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Barang Masuk Perlu Dikonfirmasi
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $pendingConfirmationIn ?? 0 }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            {{-- Ganti '#' dengan route yang sesuai nanti --}}
                            <a href="#" class="font-medium text-blue-700 hover:text-blue-900">
                                Lihat & Konfirmasi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tugas: Siapkan Barang Keluar -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                           <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-orange-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 5 17 10" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                </svg>
                           </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Barang Keluar Perlu Disiapkan
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $readyForShipmentOut ?? 0 }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                     <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                             {{-- Ganti '#' dengan route yang sesuai nanti --}}
                            <a href="#" class="font-medium text-orange-700 hover:text-orange-900">
                                Lihat & Siapkan
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Kartu Tugas -->
        </div>
    </div>
@endsection
