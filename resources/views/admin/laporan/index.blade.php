@extends('layouts.admin')

@section('title', 'Laporan Surat')

@push('styles')
<style>
    /* Menambahkan transisi halus untuk semua elemen */
    .btn-laporan {
        transition: all 0.2s ease-in-out;
    }
    /* Efek saat mouse hover di atas tombol */
    .btn-laporan:hover {
        transform: translateY(-2px); /* Tombol sedikit terangkat */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); /* Bayangan lebih jelas */
    }
    .input-field {
        display: block;
        width: 100%;
        padding: 0.6rem 1rem;
        background-color: #f9fafb;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
    }
    .input-field:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.3);
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto">
    
    {{-- BAGIAN FILTER DENGAN DESAIN BARU --}}
    <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg mb-8">
        <div class="flex items-center mb-4">
            <div class="bg-blue-100 p-2 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V10zM15 10a1 1 0 011-1h2a1 1 0 011 1v10a1 1 0 01-1 1h-2a1 1 0 01-1-1V10z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 ml-3">Filter & Cetak Laporan</h2>
        </div>
        <p class="text-gray-500 mb-6">Pilih rentang tanggal untuk melihat rekapitulasi surat dan mengekspornya.</p>

        <form action="{{ route('laporan.index') }}" method="GET" class="border-t pt-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 items-end">
                <div class="lg:col-span-1">
                    <label for="tanggal_awal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal" value="{{ $tanggal_awal ?? '' }}" required class="input-field">
                </div>
                <div class="lg:col-span-1">
                    <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" value="{{ $tanggal_akhir ?? '' }}" required class="input-field">
                </div>
                <div class="lg:col-span-3 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                    <button type="submit" class="btn-laporan flex items-center justify-center w-full bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg shadow-md hover:bg-blue-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Tampilkan
                    </button>
                    @if(isset($suratMasuk) || isset($suratKeluar))
                        <a href="{{ route('laporan.cetak', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]) }}" target="_blank" class="btn-laporan flex items-center justify-center w-full bg-red-600 text-white font-bold py-2.5 px-4 rounded-lg shadow-md hover:bg-red-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak PDF
                        </a>
                        <a href="{{ route('laporan.cetak_excel', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]) }}" class="btn-laporan flex items-center justify-center w-full bg-green-600 text-white font-bold py-2.5 px-4 rounded-lg shadow-md hover:bg-green-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                            Cetak Excel
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    {{-- HASIL LAPORAN --}}
    @if(isset($suratMasuk) || isset($suratKeluar))
        <div class="space-y-8">
            {{-- Tabel Surat Masuk --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-4 bg-gray-50 border-b">
                    <h3 class="text-xl font-semibold text-gray-800">Laporan Surat Masuk</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-800 text-white">
                            <tr>
                                <th class="py-2 px-4 text-left">No</th>
                                <th class="py-2 px-4 text-left">No. Surat</th>
                                <th class="py-2 px-4 text-left">Pengirim</th>
                                <th class="py-2 px-4 text-left">Perihal</th>
                                <th class="py-2 px-4 text-left">Tgl. Diterima</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse($suratMasuk as $surat)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-4">{{ $surat->nomor_surat }}</td>
                                    <td class="py-2 px-4">{{ $surat->pengirim }}</td>
                                    <td class="py-2 px-4">{{ $surat->perihal }}</td>
                                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($surat->tanggal_diterima)->isoFormat('D MMM YYYY') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center py-8 text-gray-500">Tidak ada data surat masuk pada periode ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Tabel Surat Keluar --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-4 bg-gray-50 border-b">
                    <h3 class="text-xl font-semibold text-gray-800">Laporan Surat Keluar</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-800 text-white">
                            <tr>
                                <th class="py-2 px-4 text-left">No</th>
                                <th class="py-2 px-4 text-left">No. Surat</th>
                                <th class="py-2 px-4 text-left">Tujuan</th>
                                <th class="py-2 px-4 text-left">Perihal</th>
                                <th class="py-2 px-4 text-left">Tgl. Surat</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse($suratKeluar as $surat)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-4">{{ $surat->nomor_surat }}</td>
                                    <td class="py-2 px-4">{{ $surat->tujuan }}</td>
                                    <td class="py-2 px-4">{{ $surat->perihal }}</td>
                                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->isoFormat('D MMM YYYY') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center py-8 text-gray-500">Tidak ada data surat keluar pada periode ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        {{-- Tampilan Interaktif Jika Belum Ada Data --}}
        <div class="text-center py-16 bg-white rounded-xl shadow-lg">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2-2H5a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">Belum Ada Laporan</h3>
            <p class="mt-1 text-sm text-gray-500">Silakan pilih rentang tanggal di atas untuk memulai.</p>
        </div>
    @endif
</div>
@endsection
