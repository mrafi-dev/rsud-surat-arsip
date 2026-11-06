<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel yang digunakan oleh model ini secara eksplisit.
     * Wajib ditambahkan karena kita tidak mengikuti konvensi jamak Laravel.
     *
     * @var string
     */
    protected $table = 'surat_masuk';

    /**
     * Atribut yang dapat diisi secara massal.
     * Ini adalah daftar kolom yang diizinkan untuk diisi melalui form.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tanggal_diterima',
        'pengirim',
        'perihal',
        'keterangan',
        'file_surat',
        'user_id',
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model User.
     * Ini memungkinkan kita untuk mengambil data user yang menginput surat.
     * Contoh: $surat->user->name
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
