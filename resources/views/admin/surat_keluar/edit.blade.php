@extends('layouts.admin')

@section('title', 'Edit Surat Keluar')

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/decoupled-document/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            DecoupledEditor
                .create( document.querySelector( '#editor' ) )
                .then( editor => {
                    document.querySelector( '#toolbar-container' ).appendChild( editor.ui.view.toolbar.element );
                    const hiddenTextarea = document.querySelector('#isi_surat');
                    editor.model.document.on('change:data', () => { hiddenTextarea.value = editor.getData(); });
                    
                    // Isi editor dengan data lama saat halaman dimuat
                    editor.setData(hiddenTextarea.value);
                } )
                .catch( error => { console.error( 'Error initializing CKEditor:', error ); } );
        });
    </script>
@endpush

@section('content')
<div class="bg-white p-6 md:p-8 rounded-lg shadow-md max-w-4xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('surat-keluar.index') }}" class="text-indigo-600 hover:text-indigo-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <h2 class="text-2xl font-bold text-gray-800 ml-4">Formulir Edit Surat Keluar</h2>
    </div>

    {{-- Arahkan form ke method update dan gunakan method PATCH --}}
    <form action="{{ route('surat-keluar.update', $suratKeluar->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PATCH')
        
        <div class="p-6 border rounded-lg">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">1. Detail Utama Surat</h3>
            <div class="space-y-4">
                {{-- Semua input diisi dengan data lama dari $suratKeluar --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nomor_surat" class="block mb-2 text-sm font-medium text-gray-700">Nomor Surat</label>
                        <input type="text" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $suratKeluar->nomor_surat) }}" required class="input-field">
                    </div>
                    <div>
                        <label for="tanggal_surat" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat', $suratKeluar->tanggal_surat) }}" required class="input-field">
                    </div>
                </div>
                {{-- Untuk Sifat, Lampiran, dan Penandatangan, kita perlu mengambilnya dari PDF lama atau menyimpannya.
                     Untuk kesederhanaan, kita akan minta user mengisinya kembali atau kita set default.
                     Di sini kita set default agar mudah. --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="sifat" class="block mb-2 text-sm font-medium text-gray-700">Sifat Surat</label>
                        <input type="text" id="sifat" name="sifat" value="{{ old('sifat', 'Penting') }}" required class="input-field">
                    </div>
                    <div>
                        <label for="lampiran" class="block mb-2 text-sm font-medium text-gray-700">Lampiran</label>
                        <input type="text" id="lampiran" name="lampiran" value="{{ old('lampiran', '-') }}" required class="input-field">
                    </div>
                </div>
                <div>
                    <label for="perihal" class="block mb-2 text-sm font-medium text-gray-700">Perihal</label>
                    <textarea id="perihal" name="perihal" rows="2" required class="input-field">{{ old('perihal', $suratKeluar->perihal) }}</textarea>
                </div>
                <div>
                    <label for="tujuan" class="block mb-2 text-sm font-medium text-gray-700">Tujuan Surat</label>
                    <textarea id="tujuan" name="tujuan" rows="3" required class="input-field">{{ old('tujuan', $suratKeluar->tujuan) }}</textarea>
                </div>
            </div>
        </div>

        <div class="p-6 border rounded-lg">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">2. Isi Surat</h3>
            <div id="editor-container" class="mt-2 border border-gray-300 rounded-lg">
                <div id="toolbar-container" class="border-b border-gray-300 bg-gray-50 rounded-t-lg"></div>
                <div id="editor" style="min-height: 400px;"></div>
            </div>
            {{-- Isi textarea dengan data HTML dari database --}}
            <textarea id="isi_surat" name="isi_surat" style="display:none;">{{ old('isi_surat', $suratKeluar->isi_surat_html) }}</textarea>
        </div>

        <div class="p-6 border rounded-lg">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">3. Detail Penandatangan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="penandatangan_jabatan" class="block mb-2 text-sm font-medium text-gray-700">Jabatan</label>
                    <input type="text" id="penandatangan_jabatan" name="penandatangan_jabatan" value="{{ old('penandatangan_jabatan', 'DIREKTUR RSUD LEMBANG') }}" required class="input-field">
                </div>
                <div>
                    <label for="penandatangan_nama" class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap (dengan gelar)</label>
                    <input type="text" id="penandatangan_nama" name="penandatangan_nama" value="{{ old('penandatangan_nama') }}" required class="input-field" placeholder="Isi kembali nama penandatangan">
                </div>
                <div class="md:col-span-2">
                    <label for="penandatangan_nip" class="block mb-2 text-sm font-medium text-gray-700">NIP</label>
                    <input type="text" id="penandatangan_nip" name="penandatangan_nip" value="{{ old('penandatangan_nip') }}" class="input-field" placeholder="Isi kembali NIP (jika ada)">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-4">
            <a href="{{ route('surat-keluar.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Update dan Buat Ulang PDF</button>
        </div>
    </form>
</div>
@endsection

@section('styles')
<style>
    .input-field { display: block; width: 100%; padding: 0.75rem 1rem; background-color: #f9fafb; border: 1px solid #d1d5db; border-radius: 0.5rem; transition: all 0.2s ease-in-out; }
    .input-field:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.3); }
    .btn-primary { background-color: #4f46e5; color: white; font-weight: 600; padding: 0.6rem 1.5rem; border-radius: 0.5rem; transition: background-color 0.2s; }
    .btn-primary:hover { background-color: #4338ca; }
    .btn-secondary { background-color: #e5e7eb; color: #1f2937; font-weight: 600; padding: 0.6rem 1.5rem; border-radius: 0.5rem; transition: background-color 0.2s; }
    .btn-secondary:hover { background-color: #d1d5db; }
</style>
@endsection
