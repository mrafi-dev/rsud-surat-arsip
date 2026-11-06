@extends('layouts.admin')

@section('title', 'Edit Arsip Surat Masuk')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-lg shadow-md">
    <div class="flex items-center mb-6">
        <a href="{{ route('surat-masuk.index') }}" class="text-indigo-600 hover:text-indigo-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <h2 class="text-2xl font-bold text-gray-800 ml-4">Formulir Edit Surat Masuk</h2>
    </div>
    <p class="text-gray-600 mb-6">Ubah data di bawah ini untuk memperbarui arsip surat masuk.</p>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Terjadi kesalahan pada input Anda.</span>
            <ul class="mt-3 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('surat-masuk.update', $suratMasuk->id) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PATCH') {{-- Metode HTTP untuk update --}}
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nomor_surat" class="block mb-2 text-sm font-medium text-gray-700">Nomor Surat</label>
                <input type="text" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}" required class="block w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label for="perihal" class="block mb-2 text-sm font-medium text-gray-700">Perihal</label>
                <input type="text" id="perihal" name="perihal" value="{{ old('perihal', $suratMasuk->perihal) }}" required class="block w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="tanggal_surat" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Surat</label>
                <input type="date" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat', $suratMasuk->tanggal_surat) }}" required class="block w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label for="tanggal_diterima" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Diterima</label>
                <input type="date" id="tanggal_diterima" name="tanggal_diterima" value="{{ old('tanggal_diterima', $suratMasuk->tanggal_diterima) }}" required class="block w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <div>
            <label for="pengirim" class="block mb-2 text-sm font-medium text-gray-700">Pengirim</label>
            <input type="text" id="pengirim" name="pengirim" value="{{ old('pengirim', $suratMasuk->pengirim) }}" required class="block w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-700">Keterangan (Opsional)</label>
            <textarea id="keterangan" name="keterangan" rows="3" class="block w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('keterangan', $suratMasuk->keterangan) }}</textarea>
        </div>

        <div>
            <label for="file_surat" class="block mb-2 text-sm font-medium text-gray-700">Upload File Baru (Opsional)</label>
            <p class="text-sm text-gray-500 mb-2">File saat ini: <a href="{{ Storage::url($suratMasuk->file_surat) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></p>
            <input type="file" id="file_surat" name="file_surat" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah file.</p>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-4 border-t mt-6">
            <a href="{{ route('surat-masuk.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-all duration-300">
                Batal
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                Update Surat
            </button>
        </div>
    </form>
</div>
@endsection
