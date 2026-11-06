<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman utama dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Data untuk Kartu Statistik & Komponen Lain
            $jumlahSuratMasuk = SuratMasuk::count();
            $jumlahSuratKeluar = SuratKeluar::count();
            $jumlahPengguna = User::count();
            $totalArsip = $jumlahSuratMasuk + $jumlahSuratKeluar;
            $recentActivities = AuditLog::with('user')->latest()->take(5)->get();
            $userRoles = User::select('role', DB::raw('count(*) as total'))->groupBy('role')->pluck('total', 'role');
            $latestUsers = User::latest()->take(5)->get();

            // Data untuk Chart Donat
            $roleChartData = [
                'labels' => $userRoles->keys(),
                'data' => $userRoles->values(),
            ];

            // BARU: Set periode default untuk grafik utama
            $periode = $request->input('periode', '6m'); 

            return view('dashboard', compact(
                'jumlahSuratMasuk', 'jumlahSuratKeluar', 'totalArsip', 'jumlahPengguna', 
                'recentActivities', 'roleChartData', 'latestUsers', 'periode'
            ));
        
        } elseif ($user->role === 'tu') {
            // ... (logika untuk TU tetap sama)
            $suratMasukHariIni = SuratMasuk::whereDate('created_at', today())->count();
            $suratKeluarHariIni = SuratKeluar::whereDate('created_at', today())->count();
            $suratMasukTerbaru = SuratMasuk::latest()->take(5)->get();
            $suratKeluarTerbaru = SuratKeluar::latest()->take(5)->get();
            return view('tu.dashboard', compact('suratMasukHariIni', 'suratKeluarHariIni', 'suratMasukTerbaru', 'suratKeluarTerbaru'));
        }

        return redirect('/login');
    }

    /**
     * BARU: Method ini khusus untuk menyediakan data grafik secara dinamis (AJAX).
     */
    public function getChartData(Request $request)
    {
        $periode = $request->input('periode', '6m');
        $labels = [];
        $dataMasuk = [];
        $dataKeluar = [];

        switch ($periode) {
            case '7d':
                for ($i = 6; $i >= 0; $i--) {
                    $tanggal = now()->subDays($i);
                    $labels[] = $tanggal->isoFormat('D MMM');
                    $dataMasuk[] = SuratMasuk::whereDate('tanggal_diterima', $tanggal)->count();
                    $dataKeluar[] = SuratKeluar::whereDate('tanggal_surat', $tanggal)->count();
                }
                break;
            case '30d':
                for ($i = 29; $i >= 0; $i--) {
                    $tanggal = now()->subDays($i);
                    $labels[] = $tanggal->isoFormat('D MMM');
                    $dataMasuk[] = SuratMasuk::whereDate('tanggal_diterima', $tanggal)->count();
                    $dataKeluar[] = SuratKeluar::whereDate('tanggal_surat', $tanggal)->count();
                }
                break;
            case '1y':
                for ($i = 11; $i >= 0; $i--) {
                    $bulan = now()->subMonths($i);
                    $labels[] = $bulan->isoFormat('MMM YYYY');
                    $dataMasuk[] = SuratMasuk::whereYear('tanggal_diterima', $bulan->year)->whereMonth('tanggal_diterima', $bulan->month)->count();
                    $dataKeluar[] = SuratKeluar::whereYear('tanggal_surat', $bulan->year)->whereMonth('tanggal_surat', $bulan->month)->count();
                }
                break;
            case '6m':
            default:
                for ($i = 5; $i >= 0; $i--) {
                    $bulan = now()->subMonths($i);
                    $labels[] = $bulan->isoFormat('MMM');
                    $dataMasuk[] = SuratMasuk::whereYear('tanggal_diterima', $bulan->year)->whereMonth('tanggal_diterima', $bulan->month)->count();
                    $dataKeluar[] = SuratKeluar::whereYear('tanggal_surat', $bulan->year)->whereMonth('tanggal_surat', $bulan->month)->count();
                }
                break;
        }

        return response()->json([
            'labels' => $labels,
            'dataMasuk' => $dataMasuk,
            'dataKeluar' => $dataKeluar,
        ]);
    }
}
