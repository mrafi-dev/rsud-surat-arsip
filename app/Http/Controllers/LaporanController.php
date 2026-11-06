<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\LaporanSuratExport; // <-- Tambahkan ini
use Maatwebsite\Excel\Facades\Excel; // <-- Tambahkan ini

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman utama laporan dengan filter tanggal.
     */
    public function index(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $suratMasuk = null;
        $suratKeluar = null;

        if ($tanggal_awal && $tanggal_akhir) {
            $suratMasuk = SuratMasuk::whereBetween('tanggal_diterima', [$tanggal_awal, $tanggal_akhir])->latest()->get();
            $suratKeluar = SuratKeluar::whereBetween('tanggal_surat', [$tanggal_awal, $tanggal_akhir])->latest()->get();
        }

        return view('admin.laporan.index', compact('suratMasuk', 'suratKeluar', 'tanggal_awal', 'tanggal_akhir'));
    }

    /**
     * Membuat dan mencetak laporan dalam format PDF.
     */
    public function cetakPdf(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        if (!$tanggal_awal || !$tanggal_akhir) {
            return redirect()->route('laporan.index')->with('error', 'Silakan pilih rentang tanggal terlebih dahulu.');
        }

        $suratMasuk = SuratMasuk::whereBetween('tanggal_diterima', [$tanggal_awal, $tanggal_akhir])->latest()->get();
        $suratKeluar = SuratKeluar::whereBetween('tanggal_surat', [$tanggal_awal, $tanggal_akhir])->latest()->get();
        $pdf = PDF::loadView('admin.laporan.pdf', compact('suratMasuk', 'suratKeluar', 'tanggal_awal', 'tanggal_akhir'));
        $fileName = 'laporan-surat-' . $tanggal_awal . '-sampai-' . $tanggal_akhir . '.pdf';

        return $pdf->stream($fileName);
    }

    /**
     * Membuat dan mengunduh laporan dalam format Excel.
     */
    public function cetakExcel(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        if (!$tanggal_awal || !$tanggal_akhir) {
            return redirect()->route('laporan.index')->with('error', 'Silakan pilih rentang tanggal terlebih dahulu.');
        }

        $fileName = 'laporan-surat-' . $tanggal_awal . '-sampai-' . $tanggal_akhir . '.xlsx';
        
        // Panggil class export yang sudah kita buat
        return Excel::download(new LaporanSuratExport($tanggal_awal, $tanggal_akhir), $fileName);
    }
}
