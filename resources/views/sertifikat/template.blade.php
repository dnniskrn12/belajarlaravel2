<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sertifikat Magang</title>
    <style>
        @font-face {
            font-family: 'Roboto Mono';
            font-style: normal;
            font-weight: 400;
            src: url("{{ public_path('fonts/RobotoMono-Regular.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'Roboto Mono';
            font-style: normal;
            font-weight: 700;
            src: url("{{ public_path('fonts/RobotoMono-Bold.ttf') }}") format('truetype');
        }

        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto Mono', monospace;
        }

        table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
            background: url('{{ public_path("storage/background/template.png") }}') no-repeat center center;
            background-size: cover;
            text-align: center;
        }

        h1 {
            font-size: 42px;
            margin: 20px 0;
            text-decoration: underline;
        }

        p {
            font-size: 20px;
            margin: 8px 40px;
            line-height: 1.5;
        }

        .footer {
            margin-top: 30px;
            font-size: 16px;
        }

        .tanggal {
            text-align: right;
            padding-right: 215px;
            font-size: 18px;
            margin-top: 48px;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td style="vertical-align: middle;">
                <br><br><br><br><br><br><br><br><br><br><br>
                <p>Nomor Sertifikat: <strong>{{ $nomorSertifikat }}</strong></p>
                <br>
                <p>Sertifikat ini diberikan kepada:</p>
                <h1>{{ $namaSiswa }}</h1>
                <p>
                    Telah berhasil menyelesaikan Program Magang
                    <strong>Dinas Komunikasi dan Informatika<br>Kota Kediri</strong> di bidang
                    <strong>{{ $unitMagang }}</strong>.
                </p>
                <p>
                    Yang dilakukan pada <strong>{{ $tglMasuk }} - {{ $tglKeluar }}</strong>.
                </p>
                <p>Terima kasih atas partisipasi dan kerja kerasnya.</p><br><br>
            </td>
        </tr>
        <tr>
            <td class="tanggal">
                Kediri, {{ \Carbon\Carbon::parse($tanggalSertifikat)->locale('id')->translatedFormat('d F Y') }}
            </td>
        </tr>
    </table>
</body>

</html>
