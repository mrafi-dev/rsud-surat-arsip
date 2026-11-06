<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Perintah untuk membuat tabel 'surat_masuk'
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id(); // Kolom ID sebagai primary key
            
            // Kolom sesuai User Requirement
            $table->string('nomor_surat')->unique(); // Nomor surat, harus unik
            $table->date('tanggal_surat'); // Tanggal yang tertera di surat
            $table->date('tanggal_diterima'); // Tanggal kapan surat diterima
            $table->string('pengirim'); // Nama pengirim surat
            $table->string('perihal'); // Perihal atau subjek surat
            $table->text('keterangan')->nullable(); // Keterangan tambahan, boleh kosong

            // Kolom untuk fungsionalitas sistem
            $table->string('file_surat'); // Menyimpan path ke file PDF yang di-upload
            
            // Menghubungkan ke tabel 'users' untuk mengetahui siapa yang menginput
            // Jika user dihapus, data surat masuk yang terkait juga akan terhapus (onDelete('cascade'))
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->timestamps(); // Membuat kolom created_at dan updated_at secara otomatis
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Perintah untuk menghapus tabel jika migrasi di-rollback
        Schema::dropIfExists('surat_masuk');
    }
};
