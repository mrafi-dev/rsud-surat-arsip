<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SuratKeluarSheetExport implements FromQuery, WithTitle, WithHeadings, WithMapping
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
        return SuratKeluar::query()->whereBetween('tanggal_surat', [$this->tanggal_awal, $this->tanggal_akhir]);
    }

    public function headings(): array
    {
        return ['Nomor Surat', 'Perihal', 'Tujuan', 'Tanggal Surat'];
    }

    public function map($surat): array
    {
        return [$surat->nomor_surat, $surat->perihal, $surat->tujuan, $surat->tanggal_surat];
    }

    public function title(): string
    {
        return 'Surat Keluar';
    }
}