@extends('layouts.admin')

@section('title', 'Arsip Surat Masuk')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 md:p-8 text-gray-900">

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
         @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            {{-- Tombol Tambah Data --}}
            <a href="{{ route('surat-masuk.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300 mb-4 md:mb-0 w-full md:w-auto text-center">
                + Input Surat Masuk
            </a>
            
            {{-- Form Pencarian --}}
            <form action="{{ route('surat-masuk.index') }}" method="GET" class="w-full md:w-1/3">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari no. surat, pengirim, perihal..." class="block w-full px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ request('search') }}">
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>
            </form>
        </div>

        {{-- Tabel Data Surat Masuk --}}
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-slate-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No. Surat</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Perihal</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Pengirim</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Tgl. Surat</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200">
                    @forelse ($suratMasuk as $surat)
                        <tr class="hover:bg-gray-50">
                            <td class="text-left py-3 px-4">{{ $loop->iteration + $suratMasuk->firstItem() - 1 }}</td>
                            <td class="text-left py-3 px-4 font-medium">{{ $surat->nomor_surat }}</td>
                            <td class="text-left py-3 px-4">{{ Str::limit($surat->perihal, 40) }}</td>
                            <td class="text-left py-3 px-4">{{ $surat->pengirim }}</td>
                            <td class="text-left py-3 px-4">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->isoFormat('D MMM YYYY') }}</td>
                            <td class="text-center py-3 px-4 flex items-center justify-center space-x-4">
                                
                                {{-- ================== INI ADALAH BARIS YANG DIPERBARUI ================== --}}
                                <a href="{{ route('surat-masuk.lihat', $surat->id) }}" target="_blank" class="text-blue-600 hover:text-blue-900 font-medium">Lihat</a>
                                {{-- ======================================================================= --}}

                                <a href="{{ route('surat-masuk.edit', $surat->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                <form action="{{ route('surat-masuk.destroy', $surat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-gray-500">
                                Tidak ada data surat masuk untuk ditampilkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Link Paginasi --}}
        <div class="mt-6">
            {{ $suratMasuk->links() }}
        </div>

    </div>
</div>
@endsection
