<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    /**
     * Menampilkan daftar semua surat masuk.
     */
    public function index(Request $request)
    {
        // ================== LOGIKA BARU ==================
        // Hanya bersihkan notifikasi jika pengguna mengunjungi halaman ini secara normal,
        // bukan saat diarahkan kembali setelah membuat surat baru.
        if (!session('surat_baru_dibuat')) {
            SuratMasuk::where('dilihat', false)->update(['dilihat' => true]);
        }
        // =================================================

        $query = SuratMasuk::query()->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nomor_surat', 'like', '%' . $search . '%')
                  ->orWhere('pengirim', 'like', '%' . $search . '%')
                  ->orWhere('perihal', 'like', '%' . $search . '%');
        }

        $suratMasuk = $query->paginate(10);
        return view('admin.surat_masuk.index', compact('suratMasuk'));
    }

    /**
     * Menampilkan form untuk membuat surat masuk baru.
     */
    public function create()
    {
        return view('admin.surat_masuk.create');
    }

    /**
     * Menyimpan data surat masuk baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_masuk',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'file_surat' => 'required|mimes:pdf|max:2048',
        ]);

        $path = $request->file('file_surat')->store('surat-masuk', 'public');

        SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_diterima' => $request->tanggal_diterima,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'keterangan' => $request->keterangan,
            'file_surat' => $path,
            'user_id' => Auth::id(),
        ]);

        // AUDIT LOG
        AuditLog::create([
            'user_id'   => Auth::id(),
            'activity'  => 'TAMBAH SURAT MASUK',
            'description' => 'Menambahkan surat masuk baru dengan nomor ' . $request->nomor_surat,
        ]);

        return redirect()->route('surat-masuk.index')
                         ->with('success', 'Surat masuk berhasil ditambahkan.')
                         // ================== LOGIKA BARU ==================
                         // Tambahkan "penanda" sementara ke session agar notifikasi tidak langsung hilang
                         ->with('surat_baru_dibuat', true);
                         // =================================================
    }

    /**
     * Menampilkan form untuk mengedit data surat masuk.
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        return view('admin.surat_masuk.edit', compact('suratMasuk'));
    }

    /**
     * Memperbarui data surat masuk di database.
     */
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_masuk,nomor_surat,' . $suratMasuk->id,
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'file_surat' => 'nullable|mimes:pdf|max:2048',
        ]);

        $path = $suratMasuk->file_surat;
        if ($request->hasFile('file_surat')) {
            Storage::disk('public')->delete($suratMasuk->file_surat);
            $path = $request->file('file_surat')->store('surat-masuk', 'public');
        }

        $suratMasuk->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_diterima' => $request->tanggal_diterima,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'keterangan' => $request->keterangan,
            'file_surat' => $path,
        ]);

        // AUDIT LOG
        AuditLog::create([
            'user_id'   => Auth::id(),
            'activity'  => 'UBAH SURAT MASUK',
            'description' => 'Memperbarui data surat masuk dengan nomor ' . $request->nomor_surat,
        ]);

        return redirect()->route('surat-masuk.index')
                         ->with('success', 'Data surat masuk berhasil diperbarui.');
    }

    /**
     * Menghapus data surat masuk dari database.
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        $nomorSurat = $suratMasuk->nomor_surat;

        Storage::disk('public')->delete($suratMasuk->file_surat);
        $suratMasuk->delete();

        // AUDIT LOG
        AuditLog::create([
            'user_id'   => Auth::id(),
            'activity'  => 'HAPUS SURAT MASUK',
            'description' => 'Menghapus surat masuk dengan nomor ' . $nomorSurat,
        ]);

        return redirect()->route('surat-masuk.index')
                         ->with('success', 'Surat masuk berhasil dihapus.');
    }

    /**
     * Menampilkan file PDF secara inline di browser.
     */
    public function lihatPdf(SuratMasuk $suratMasuk)
    {
        $path = storage_path('app/public/' . $suratMasuk->file_surat);

        if (!file_exists($path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);
    }
}

