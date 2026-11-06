@extends('layouts.admin')

@section('title', 'Dashboard Tata Usaha')

@section('content')
    <div class="space-y-8">
        {{-- Header Sambutan --}}
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="mt-2 text-gray-600">Ini adalah ringkasan aktivitas surat-menyurat Anda hari ini.</p>
        </div>

        {{-- Kartu Statistik Harian & Aksi Cepat --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Kartu Surat Masuk Hari Ini -->
            <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 font-medium">Surat Masuk (Hari Ini)</h3>
                    <p class="text-4xl font-bold mt-2 text-blue-600">{{ $suratMasukHariIni }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M12 12a4 4 0 100-8 4 4 0 000 8z" /></svg>
                </div>
            </div>
            <!-- Kartu Surat Keluar Hari Ini -->
            <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 font-medium">Surat Keluar (Hari Ini)</h3>
                    <p class="text-4xl font-bold mt-2 text-green-600">{{ $suratKeluarHariIni }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
            </div>
            <!-- Tombol Aksi Cepat -->
            <a href="{{ route('surat-masuk.create') }}" class="bg-blue-600 text-white p-6 rounded-xl shadow-md flex flex-col items-center justify-center hover:bg-blue-700 transition-colors">
                <svg class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="font-semibold">Input Surat Masuk</span>
            </a>
            <a href="{{ route('surat-keluar.create') }}" class="bg-green-600 text-white p-6 rounded-xl shadow-md flex flex-col items-center justify-center hover:bg-green-700 transition-colors">
                <svg class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="font-semibold">Buat Surat Keluar</span>
            </a>
        </div>

        {{-- Daftar Surat Terbaru --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Kolom Surat Masuk Terbaru -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="font-bold text-gray-800 text-lg mb-4">5 Surat Masuk Terbaru</h3>
                <div class="space-y-4">
                    @forelse ($suratMasukTerbaru as $surat)
                        <div class="border-b pb-3">
                            <div class="flex justify-between items-start">
                                <p class="font-semibold text-gray-700">{{ $surat->perihal }}</p>
                                <span class="text-xs text-gray-500">{{ $surat->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Dari: {{ $surat->pengirim }} (No: {{ $surat->nomor_surat }})</p>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Belum ada surat masuk.</p>
                    @endforelse
                </div>
            </div>

            <!-- Kolom Surat Keluar Terbaru -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="font-bold text-gray-800 text-lg mb-4">5 Surat Keluar Terbaru</h3>
                <div class="space-y-4">
                    @forelse ($suratKeluarTerbaru as $surat)
                        <div class="border-b pb-3">
                            <div class="flex justify-between items-start">
                                <p class="font-semibold text-gray-700">{{ $surat->perihal }}</p>
                                <span class="text-xs text-gray-500">{{ $surat->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Tujuan: {{ $surat->tujuan }} (No: {{ $surat->nomor_surat }})</p>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Belum ada surat keluar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
