<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanSuratExport implements WithMultipleSheets
{
    use Exportable;

    protected $tanggal_awal;
    protected $tanggal_akhir;

    public function __construct($tanggal_awal, $tanggal_akhir)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
    }

    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new SuratMasukSheetExport($this->tanggal_awal, $this->tanggal_akhir);
        $sheets[] = new SuratKeluarSheetExport($this->tanggal_awal, $this->tanggal_akhir);
        return $sheets;
    }
}