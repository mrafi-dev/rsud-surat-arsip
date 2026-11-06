<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\AuditLog; // 1. Impor model AuditLog
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratKeluar::query()->latest();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nomor_surat', 'like', '%' . $search . '%')
                  ->orWhere('tujuan', 'like', '%' . $search . '%')
                  ->orWhere('perihal', 'like', '%' . $search . '%');
        }
        $suratKeluar = $query->paginate(10);
        return view('admin.surat_keluar.index', compact('suratKeluar'));
    }

    public function create()
    {
        return view('admin.surat_keluar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_keluar',
            'tanggal_surat' => 'required|date',
            // ... validasi lainnya ...
            'penandatangan_nama' => 'required|string|max:255',
            'penandatangan_nip' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $pdf = PDF::loadView('admin.surat_keluar.template', $data);
        $fileName = 'surat-keluar-' . time() . '.pdf';
        $filePath = 'surat-keluar/' . $fileName;
        Storage::disk('public')->put($filePath, $pdf->output());

        SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan' => $request->tujuan,
            'perihal' => $request->perihal,
            'keterangan' => strip_tags($request->isi_surat),
            'isi_surat_html' => $request->isi_surat,
            'file_surat' => $filePath,
            'user_id' => Auth::id(),
        ]);

        // ================= AUDIT LOG: TAMBAH SURAT KELUAR =================
        AuditLog::create([
            'user_id'   => Auth::id(),
            'activity'  => 'TAMBAH SURAT KELUAR',
            'description' => 'Menambahkan surat keluar baru dengan nomor ' . $request->nomor_surat,
        ]);
        // =================================================================

        return redirect()->route('surat-keluar.index')
                         ->with('success', 'Surat keluar berhasil dibuat dan diarsipkan.');
    }

    public function edit(SuratKeluar $suratKeluar)
    {
        return view('admin.surat_keluar.edit', compact('suratKeluar'));
    }

    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_keluar,nomor_surat,' . $suratKeluar->id,
            // ... validasi lainnya ...
            'penandatangan_nip' => 'nullable|string|max:255',
        ]);

        Storage::disk('public')->delete($suratKeluar->file_surat);

        $data = $request->all();
        $pdf = PDF::loadView('admin.surat_keluar.template', $data);
        $fileName = 'surat-keluar-' . time() . '.pdf';
        $filePath = 'surat-keluar/' . $fileName;
        Storage::disk('public')->put($filePath, $pdf->output());

        $suratKeluar->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan' => $request->tujuan,
            'perihal' => $request->perihal,
            'keterangan' => strip_tags($request->isi_surat),
            'isi_surat_html' => $request->isi_surat,
            'file_surat' => $filePath,
        ]);

        // ================= AUDIT LOG: UBAH SURAT KELUAR =================
        AuditLog::create([
            'user_id'   => Auth::id(),
            'activity'  => 'UBAH SURAT KELUAR',
            'description' => 'Memperbarui data surat keluar dengan nomor ' . $request->nomor_surat,
        ]);
        // ===============================================================

        return redirect()->route('surat-keluar.index')
                         ->with('success', 'Surat keluar berhasil diperbarui.')
                         ->with('highlight', $suratKeluar->id);
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        // Simpan dulu nomor suratnya sebelum dihapus
        $nomorSurat = $suratKeluar->nomor_surat;

        Storage::disk('public')->delete($suratKeluar->file_surat);
        $suratKeluar->delete();

        // ================= AUDIT LOG: HAPUS SURAT KELUAR =================
        AuditLog::create([
            'user_id'   => Auth::id(),
            'activity'  => 'HAPUS SURAT KELUAR',
            'description' => 'Menghapus surat keluar dengan nomor ' . $nomorSurat,
        ]);
        // ================================================================

        return redirect()->route('surat-keluar.index')
                         ->with('success', 'Surat keluar berhasil dihapus.');
    }

    /**
     * Menampilkan file PDF secara inline di browser. (Tambahan untuk fix 403 Forbidden)
     */
    public function lihatPdf(SuratKeluar $suratKeluar)
    {
        $path = storage_path('app/public/' . $suratKeluar->file_surat);

        if (!file_exists($path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);
    }
}
