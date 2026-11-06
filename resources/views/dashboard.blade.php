@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    {{-- KARTU STATISTIK (SEKARANG BISA DIKLIK) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <a href="{{ route('surat-masuk.index') }}" class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between hover:shadow-lg hover:scale-105 transition-all duration-300">
            <div>
                <h3 class="text-gray-600 font-medium">Surat Masuk</h3>
                <p class="text-3xl font-bold mt-2">{{ $jumlahSuratMasuk }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M12 12a4 4 0 100-8 4 4 0 000 8z" /></svg>
            </div>
        </a>
        <a href="{{ route('surat-keluar.index') }}" class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between hover:shadow-lg hover:scale-105 transition-all duration-300">
            <div>
                <h3 class="text-gray-600 font-medium">Surat Keluar</h3>
                <p class="text-3xl font-bold mt-2">{{ $jumlahSuratKeluar }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
            </div>
        </a>
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-gray-600 font-medium">Total Arsip</h3>
                <p class="text-3xl font-bold mt-2">{{ $totalArsip }}</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <svg class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
            </div>
        </div>
        <a href="{{ route('users.index') }}" class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between hover:shadow-lg hover:scale-105 transition-all duration-300">
            <div>
                <h3 class="text-gray-600 font-medium">Jumlah Pengguna</h3>
                <p class="text-3xl font-bold mt-2">{{ $jumlahPengguna }}</p>
            </div>
            <div class="bg-indigo-100 p-3 rounded-full">
                <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
        </a>
    </div>

    {{-- GRAFIK & AKTIVITAS --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-md">
            {{-- BARU: TOMBOL FILTER --}}
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-medium text-gray-700">Grafik Surat per Bulan</h3>
                <div class="flex space-x-2 text-sm">
                    <button data-period="7d" class="chart-filter px-3 py-1 rounded-md {{ $periode == '7d' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">7H</button>
                    <button data-period="30d" class="chart-filter px-3 py-1 rounded-md {{ $periode == '30d' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">30H</button>
                    <button data-period="6m" class="chart-filter px-3 py-1 rounded-md {{ $periode == '6m' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">6B</button>
                    <button data-period="1y" class="chart-filter px-3 py-1 rounded-md {{ $periode == '1y' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">1T</button>
                </div>
            </div>
            <div class="relative h-80">
                <canvas id="suratChart"></canvas>
            </div>
        </div>
        {{-- ... (bagian Aktivitas Terbaru tetap sama) ... --}}
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="font-medium text-gray-700 mb-4">Aktivitas Terbaru</h3>
            <ul class="space-y-4">
                @forelse ($recentActivities as $activity)
                    <li class="flex items-start">
                        <div class="bg-gray-100 p-2 rounded-full mr-3 mt-1">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-800"><span class="font-semibold">{{ $activity->user->name ?? 'User Dihapus' }}</span></p>
                            <p class="text-xs text-gray-500 mt-1">{{ $activity->description }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </li>
                @empty
                    <li class="text-center text-sm text-gray-500 py-4">Belum ada aktivitas tercatat.</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- ... (bagian Grafik Donat dan Pengguna Baru tetap sama) ... --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="font-medium text-gray-700 mb-4">Komposisi Pengguna</h3>
            <div class="relative h-64 md:h-80 flex justify-center items-center">
                <canvas id="roleChart"></canvas>
            </div>
        </div>
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-medium text-gray-700">Pengguna Baru Ditambahkan</h3>
                <a href="{{ route('users.index') }}" class="text-sm text-blue-600 hover:underline">Kelola Pengguna</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50"><tr><th class="px-4 py-2">Nama</th><th class="px-4 py-2">Email</th><th class="px-4 py-2">Role</th><th class="px-4 py-2">Tanggal Daftar</th></tr></thead>
                    <tbody>
                        @forelse ($latestUsers as $user)
                            <tr class="border-b"><td class="px-4 py-3">{{ $user->name }}</td><td class="px-4 py-3">{{ $user->email }}</td><td class="px-4 py-3"><span class="px-2 py-1 text-xs rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">{{ ucfirst($user->role) }}</span></td><td class="px-4 py-3">{{ $user->created_at->isoFormat('D MMM YYYY') }}</td></tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-4 text-gray-500">Belum ada pengguna baru.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data dari Controller
        const donutChartData = @json($roleChartData);
        let lineChartInstance; // Variabel untuk menyimpan instance chart

        // Inisialisasi Grafik Garis (Line Chart)
        const ctxLine = document.getElementById('suratChart').getContext('2d');
        const updateLineChart = (data) => {
            if (lineChartInstance) {
                lineChartInstance.destroy(); // Hancurkan chart lama
            }
            lineChartInstance = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [
                        { label: 'Surat Masuk', data: data.dataMasuk, borderColor: 'rgb(59, 130, 246)', backgroundColor: 'rgba(59, 130, 246, 0.1)', fill: true, tension: 0.4 },
                        { label: 'Surat Keluar', data: data.dataKeluar, borderColor: 'rgb(16, 185, 129)', backgroundColor: 'rgba(16, 185, 129, 0.1)', fill: true, tension: 0.4 }
                    ]
                },
                options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
            });
        };

        // Fungsi untuk mengambil data chart dari server
        const fetchChartData = (period) => {
            fetch(`{{ route('dashboard.chartData') }}?periode=${period}`)
                .then(response => response.json())
                .then(data => {
                    updateLineChart(data);
                });
        };

        // Event listener untuk tombol filter
        document.querySelectorAll('.chart-filter').forEach(button => {
            button.addEventListener('click', function() {
                const period = this.dataset.period;
                fetchChartData(period);

                // Update tampilan tombol aktif
                document.querySelectorAll('.chart-filter').forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                });
                this.classList.add('bg-blue-600', 'text-white');
                this.classList.remove('bg-gray-200', 'text-gray-700');
            });
        });

        // Muat data chart awal saat halaman dibuka
        fetchChartData('{{ $periode }}');

        // Inisialisasi Grafik Donat (Donut Chart)
        const ctxDonut = document.getElementById('roleChart').getContext('2d');
        new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: donutChartData.labels.map(label => label.charAt(0).toUpperCase() + label.slice(1)),
                datasets: [{
                    data: donutChartData.data,
                    backgroundColor: ['rgba(239, 68, 68, 0.8)', 'rgba(34, 197, 94, 0.8)', 'rgba(251, 146, 60, 0.8)'],
                    borderColor: '#ffffff',
                    borderWidth: 2,
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });
    });
</script>
@endpush
