<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel yang digunakan oleh model ini secara eksplisit.
     *
     * @var string
     */
    protected $table = 'surat_keluar';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tujuan',
        'perihal',
        'keterangan',
        'file_surat',
        'user_id',
        'isi_surat_html', // <-- INI ADALAH BARIS YANG DITAMBAHKAN
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model User.
     * Ini memungkinkan kita untuk mengambil data user yang membuat surat.
     * Contoh: $surat->user->name
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
