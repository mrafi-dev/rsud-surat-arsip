<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Menampilkan halaman riwayat aktivitas (log) dengan fitur pencarian dan filter.
     */
    public function index(Request $request)
    {
        // Mulai query ke model AuditLog, urutkan dari yang terbaru
        $query = AuditLog::with('user')->latest();

        // 1. Logika untuk Pencarian (Search)
        // Jika ada input 'search', filter deskripsi log
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        // 2. Logika untuk Filter berdasarkan Pengguna
        // Jika ada input 'user_id' yang dipilih, filter log berdasarkan user tersebut
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Ambil hasil query dengan pagination (15 data per halaman)
        $logs = $query->paginate(15)->withQueryString();

        // Ambil semua data user untuk ditampilkan di dropdown filter
        $users = User::orderBy('name')->get();

        // Kirim data logs dan users ke view
        return view('admin.logs.index', compact('logs', 'users'));
    }
}
