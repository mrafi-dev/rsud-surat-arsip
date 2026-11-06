<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keluar - {{ $nomor_surat }}</title>
    <style>
        @page { margin: 2.5cm; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; }
        .kop-surat-container { position: relative; text-align: center; border-bottom: 3px solid black; padding-bottom: 15px; margin-bottom: 1cm; }
        .logo { position: absolute; top: 0; left: 0; width: 75px; }
        .kop-surat-text { margin-left: 90px; }
        .kop-surat-text .instansi { font-size: 14pt; font-weight: bold; }
        .kop-surat-text .rsud { font-size: 18pt; font-weight: bold; }
        .kop-surat-text .alamat { font-size: 10pt; }
        .content { margin-top: 1cm; text-align: justify; }
        .signature-container { margin-top: 1.5cm; width: 45%; margin-left: 55%; text-align: center; }
        .signature-container .jabatan { text-transform: uppercase; }
        .signature-container .nama { font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="kop-surat-container">
        <img src="{{ public_path('images/logo-kbb.png') }}" alt="Logo KBB" class="logo">
        <div class="kop-surat-text">
            <div class="instansi">PEMERINTAH KABUPATEN BANDUNG BARAT</div>
            <div class="instansi">DINAS KESEHATAN</div>
            <div class="rsud">RUMAH SAKIT UMUM DAERAH LEMBANG</div>
            <div class="alamat">Jl. Raya Lembang Km.11, 4 No. 11 Kabupaten Bandung Barat 40391 Tlp. (022) 27613399, e-mail: rsudlembang@gmail.com</div>
        </div>
    </div>

    <table style="width: 100%;">
        <tr>
            <td style="width: 60%;">
                <table style="border-collapse: collapse;">
                    <tr>
                        <td style="padding-right: 10px;">Nomor</td>
                        <td>:</td>
                        <td style="padding-left: 5px;">{{ $nomor_surat }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 10px;">Sifat</td>
                        <td>:</td>
                        <td style="padding-left: 5px;">{{ $sifat }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 10px;">Lampiran</td>
                        <td>:</td>
                        <td style="padding-left: 5px;">{{ $lampiran }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 10px;">Perihal</td>
                        <td>:</td>
                        <td style="padding-left: 5px;"><b>{{ $perihal }}</b></td>
                    </tr>
                </table>
            </td>
            <td style="width: 40%; vertical-align: top;">
                Lembang, {{ \Carbon\Carbon::parse($tanggal_surat)->isoFormat('D MMMM YYYY') }}
            </td>
        </tr>
    </table>

    <div style="margin-top: 1cm;">
        Kepada Yth.<br>
        <b>{{ $tujuan }}</b><br>
        di<br>
        Tempat
    </div>

    <div class="content">
        {!! $isi_surat !!}
    </div>

    <div class="signature-container">
        <div class="jabatan">{{ $penandatangan_jabatan }},</div>
        <div style="height: 80px;"></div>
        <div class="nama">{{ $penandatangan_nama }}</div>
        <div>NIP. {{ $penandatangan_nip }}</div>
    </div>
</body>
</html>
