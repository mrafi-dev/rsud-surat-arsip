<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::table('surat_masuk', function (Blueprint $table) {
        // Tambah kolom 'dilihat', defaultnya false (artinya belum dilihat)
        $table->boolean('dilihat')->default(false)->after('file_surat');
    });
}

public function down(): void
{
    Schema::table('surat_masuk', function (Blueprint $table) {
        $table->dropColumn('dilihat');
    });
}
};
