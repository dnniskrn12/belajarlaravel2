<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Surat Keputusan Magang - {{ $sk->nama_siswa }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px 60px;
            color: #000;
        }

        header {
            display: flex;
            align-items: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .header-text {
            flex-grow: 1;
            text-align: center;
            line-height: 1.3;
        }

        .header-text h1 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text p {
            margin: 3px 0;
            font-size: 13px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            margin: 20px 0 15px 0;
            text-decoration: underline;
        }

        .content {
            font-size: 15px;
            line-height: 1.6;
            text-align: justify;
        }

        .content p {
            margin: 10px 0;
        }

        .data-list {
            margin: 15px 0 20px 30px;
        }

        .data-list p {
            margin: 6px 0;
        }

        .signature-section {
            margin-top: 60px;
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }

        .signature-block {
            text-align: center;
            width: 300px;
        }

        .signature-block .name {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }

        .signature-block .position {
            margin-top: 4px;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="report-container">
        <!-- Header -->
        <div class="header"
            style="display: flex; align-items: flex-start; border-bottom: 3px solid #000000; padding: 10px 0;">

            <!-- Logo -->
            <div style="flex: 0 0 70px; text-align: center;">
                <img src="{{ public_path('storage/background/logo.png')}}" alt="Logo"
                    style="width: 50px; height: auto;">
            </div>

            <!-- Teks Kop -->
            <div style="flex: 1; text-align: center; padding-top: 5px;">
                <h1 style="margin: 0; font-size: 18px; font-weight: 700; letter-spacing: 1px; line-height: 1.4;">
                    DINAS KOMUNIKASI DAN INFORMATIKA KOTA KEDIRI
                </h1>
                <p style="margin: 2px 0; font-size: 12px; color: #374151;">
                    Jln. Himalaya No.4 Sukorame, Kec. Mojoroto, Kediri, Jawa Timur 64114
                </p>
                <p style="margin: 2px 0; font-size: 12px; color: #374151;">
                    Laman: diskominfo.kedirikota.go.id | Email: kominfo@kedirikota.go.id
                </p>
            </div>
        </div>

        <div class="title">SURAT KEPUTUSAN MAGANG</div>
        <p style="text-align: center"><strong>Nomor :</strong> {{ $sk->no_sk }}</p>

        <div class="content">

            <p>Yang bertanda tangan di bawah ini, Kepala Dinas Komunikasi dan Informatika Kota Kediri, dengan ini
                menetapkan:</p>

            <div class="data-list">
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <tr>
                        <td style="width: 180px; padding: 4px 8px; font-weight: bold;">Nama Siswa</td>
                        <td style="padding: 4px 8px;">: {{ $sk->nama_siswa }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 8px; font-weight: bold;">Nomor Induk Siswa</td>
                        <td style="padding: 4px 8px;">: {{ $sk->no_magang }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 8px; font-weight: bold;">Unit Magang</td>
                        <td style="padding: 4px 8px;">: {{ $sk->unit_magang?->nama_unitmagang }}</td>
                    </tr>
                </table>
            </div>

            <p>Kepada yang bersangkutan diberikan kesempatan untuk melaksanakan kegiatan magang sesuai dengan bidang
                yang telah ditetapkan dan wajib menjalankan kegiatan tersebut dengan sebaik-baiknya.</p>

            <p>Surat keputusan ini berlaku sejak tanggal
                {{ \Carbon\Carbon::parse($sk->tgl_sk)->translatedFormat('d F Y') }}
                sampai dengan berakhirnya masa magang, dan apabila terdapat kekeliruan dalam keputusan ini akan
                dilakukan perbaikan sebagaimana mestinya.
            </p>

        </div>
@php
    $kepalaDinas = \App\Models\User::whereHas('role', function($q) {
        $q->where('name', 'pimpinan');
    })->first();
@endphp
        <div class="signature-section" style="width: 100%; margin-top: 50px; text-align: right;">
            <div class="signature-block" style="display: inline-block; text-align: center;">
                <p>Kediri, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p style="margin: 0;">Kepala Dinas Komunikasi dan Informatika</p>
                <div style="height: 100px;"></div> <!-- ruang tanda tangan -->
                <p style="margin: 0; font-weight: bold; text-decoration: underline;">Nama Kepala Dinas</p>
                <p style="margin: 0; font-weight: bold; text-decoration: underline;">
    {{ $kepalaDinas ? $kepalaDinas->username : 'Belum Ada Pimpinan' }}
</p>
            </div>
        </div>
</body>

</html>
