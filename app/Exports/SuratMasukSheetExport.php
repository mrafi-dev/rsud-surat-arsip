<?php

namespace App\Exports;

use App\Models\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SuratMasukSheetExport implements FromQuery, WithTitle, WithHeadings, WithMapping
{
    private $tanggal_awal;
    private $tanggal_akhir;

    public function __construct($tanggal_awal, $tanggal_akhir)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
    }

    public function query()
    {
        return SuratMasuk::query()->whereBetween('tanggal_diterima', [$this->tanggal_awal, $this->tanggal_akhir]);
    }

    public function headings(): array
    {
        return ['Nomor Surat', 'Perihal', 'Pengirim', 'Tanggal Surat', 'Tanggal Diterima'];
    }

    public function map($surat): array
    {
        return [$surat->nomor_surat, $surat->perihal, $surat->pengirim, $surat->tanggal_surat, $surat->tanggal_diterima];
    }

    public function title(): string
    {
        return 'Surat Masuk';
    }
}