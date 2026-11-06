<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            // Tambahkan kolom untuk menyimpan HTML dari editor setelah kolom 'keterangan'
            $table->longText('isi_surat_html')->nullable()->after('keterangan');
        });
    }

    public function down(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            $table->dropColumn('isi_surat_html');
        });
    }
};