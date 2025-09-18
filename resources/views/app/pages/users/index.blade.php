@extends('app.layouts.app')

@section('content')
    <div class="p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Manajemen Pengguna
        </h1>

        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Role</th>
                            <th scope="col" class="px-6 py-3">Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    {{-- Kita akan isi bagian ini menggunakan JavaScript --}}
                    <tbody id="users-table-body">
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center">Memuat data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // URL endpoint API kita
        const apiUrl = '/api/users';

        // NOTE: Untuk development, kita hardcode token dulu.
        // Nanti di aplikasi sesungguhnya, token ini akan didapat setelah user login.
        const apiToken = '4|L6VjLfdU3azZWiXfa4ztAmLWak5y4fV2wNt3juWm94cd84a5';

        // Ambil elemen tabel body
        const tableBody = document.getElementById('users-table-body');

        // Gunakan Fetch API untuk mengambil data
        fetch(apiUrl, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${apiToken}`,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            // Kosongkan tabel body dari tulisan "Memuat data..."
            tableBody.innerHTML = '';

            // Loop melalui setiap user di dalam data
            data.data.forEach(user => {
                // Buat baris tabel baru (tr)
                const row = document.createElement('tr');
                row.className = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700';

                // Isi HTML untuk setiap baris
                row.innerHTML = `
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${user.name}</th>
                    <td class="px-6 py-4">${user.email}</td>
                    <td class="px-6 py-4">${user.role}</td>
                    <td class="px-6 py-4">${user.created_at}</td>
                `;

                // Tambahkan baris baru ke dalam tabel body
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            tableBody.innerHTML = '<tr><td colspan="4" class="px-6 py-4 text-center text-red-500">Gagal memuat data.</td></tr>';
        });
    });
</script>
@endpush