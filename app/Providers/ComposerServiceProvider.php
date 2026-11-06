<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\SuratMasuk;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Kode ini akan berjalan setiap kali view 'layouts.admin' dipanggil
        View::composer('layouts.admin', function ($view) {
            // Tugasnya sederhana: hitung jumlah surat masuk yang belum dilihat di database
            $jumlahSuratBaru = SuratMasuk::where('dilihat', false)->count();

            // Kirim variabel 'notif_surat_masuk' ke view tersebut
            $view->with('notif_surat_masuk', $jumlahSuratBaru);
        });
    }
}