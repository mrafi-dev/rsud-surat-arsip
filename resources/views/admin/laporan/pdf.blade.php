<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Surat Menyurat</title>
    <style>
        /* Mengatur font dan margin halaman */
        @page {
            margin: 2cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.4;
        }
        /* Styling untuk Kop Surat */
        .kop-surat-container {
            position: relative;
            text-align: center;
            border-bottom: 4px double black; /* Garis ganda tebal */
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .logo {
            position: absolute;
            top: 0;
            left: 0;
            width: 70px; /* Ukuran logo */
        }
        .kop-surat-text {
            margin-left: 85px; /* Memberi ruang untuk logo */
        }
        .kop-surat-text .instansi {
            font-size: 14pt;
            font-weight: bold;
        }
        .kop-surat-text .rsud {
            font-size: 18pt;
            font-weight: bold;
        }
        .kop-surat-text .alamat {
            font-size: 9pt;
        }
        /* Styling untuk Judul Laporan */
        .report-title {
            text-align: center;
            margin-bottom: 25px;
        }
        .report-title h3 {
            margin: 0;
            font-size: 14pt;
            text-decoration: underline;
            font-weight: bold;
        }
        .report-title p {
            margin: 5px 0 0 0;
            font-size: 12pt;
        }
        /* Styling untuk Tabel */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        .table th {
            background-color: #e8e8e8; /* Warna abu-abu muda untuk header */
            text-align: center;
            font-weight: bold;
        }
        .table td.text-center {
            text-align: center;
        }
        /* Styling untuk Judul Bagian */
        .section-title {
            font-size: 12pt;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    {{-- KOP SURAT --}}
    <div class="kop-surat-container">
        <img src="{{ public_path('images/logo-kbb.png') }}" alt="Logo KBB" class="logo">
        <div class="kop-surat-text">
            <div class="instansi">PEMERINTAH KABUPATEN BANDUNG BARAT</div>
            <div class="instansi">DINAS KESEHATAN</div>
            <div class="rsud">RUMAH SAKIT UMUM DAERAH LEMBANG</div>
            <div class="alamat">Jl. Raya Lembang Km.11, 4 No. 11 Kabupaten Bandung Barat 40391 Tlp. (022) 27613399, e-mail: rsudlembang@gmail.com</div>
        </div>
    </div>

    {{-- JUDUL LAPORAN --}}
    <div class="report-title">
        <h3>REKAPITULASI SURAT</h3>
        <p>Periode: {{ \Carbon\Carbon::parse($tanggal_awal)->isoFormat('D MMMM YYYY') }} s/d {{ \Carbon\Carbon::parse($tanggal_akhir)->isoFormat('D MMMM YYYY') }}</p>
    </div>

    {{-- TABEL SURAT MASUK --}}
    <div class="section-title">A. Surat Masuk</div>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">No. Surat</th>
                <th>Pengirim</th>
                <th>Perihal</th>
                <th style="width: 20%;">Tgl. Diterima</th>
            </tr>
        </thead>
        <tbody>
            @forelse($suratMasuk as $surat)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $surat->nomor_surat }}</td>
                    <td>{{ $surat->pengirim }}</td>
                    <td>{{ $surat->perihal }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($surat->tanggal_diterima)->isoFormat('D MMM YYYY') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Tidak ada data surat masuk pada periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- TABEL SURAT KELUAR --}}
    <div class="section-title">B. Surat Keluar</div>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">No. Surat</th>
                <th>Tujuan</th>
                <th>Perihal</th>
                <th style="width: 20%;">Tgl. Surat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($suratKeluar as $surat)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $surat->nomor_surat }}</td>
                    <td>{{ $surat->tujuan }}</td>
                    <td>{{ $surat->perihal }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->isoFormat('D MMM YYYY') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Tidak ada data surat keluar pada periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
