<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Laporan Data Sertifikat Magang</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 11pt;
            margin: 30px;
            color: #111827;
            background: #fff;
        }

        h1 {
            text-align: center;
            color: #000;
            margin-bottom: 4px;
            font-size: 18pt;
            text-decoration: underline;
        }

        p.subtitle {
            text-align: center;
            color: #6b7280;
            margin-top: 0;
            margin-bottom: 28px;
            font-size: 12pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 10.5pt;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 8px 12px;
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background-color: #4f46e5;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 10pt;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .status-tersertifikat {
            color: #166534;
            background: #dcfce7;
            padding: 4px 10px;
            border-radius: 16px;
            font-weight: 600;
            font-size: 9pt;
            display: inline-block;
        }

        .status-belum {
            color: #b45309;
            background: #fef3c7;
            padding: 4px 10px;
            border-radius: 16px;
            font-weight: 600;
            font-size: 9pt;
            display: inline-block;
        }

        footer {
            text-align: center;
            font-size: 10pt;
            color: #6b7280;
            margin-top: 50px;
            border-top: 1px solid #e5e7eb;
            padding-top: 12px;
        }

        @media print {
            body {
                margin: 0;
                font-size: 11pt;
            }

            footer {
                position: fixed;
                bottom: 10px;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Kop Surat -->
    <div style="display: flex; align-items: flex-start; border-bottom: 3px solid #000; padding: 10px 0; margin-bottom: 20px;">
        <div style="flex: 0 0 70px; text-align: center;">
            <img src="{{ public_path('storage/background/logo.png') }}" alt="Logo"
                style="width: 55px; height: auto;">
        </div>
        <div style="flex: 1; text-align: center; padding-top: 5px;">
            <h2 style="margin: 0; font-size: 18px; font-weight: 700; letter-spacing: 1px; line-height: 1.4;">
                DINAS KOMUNIKASI DAN INFORMATIKA KOTA KEDIRI
            </h2>
            <p style="margin: 2px 0; font-size: 12px; color: #374151;">
                Jln. Himalaya No.4 Sukorame, Kec. Mojoroto, Kediri, Jawa Timur 64114
            </p>
            <p style="margin: 2px 0; font-size: 12px; color: #374151;">
                Laman: diskominfo.kedirikota.go.id | Email: kominfo@kedirikota.go.id
            </p>
        </div>
    </div>

    <h1>LAPORAN SERTIFIKAT SISWA MAGANG</h1>
    <p class="subtitle">Daftar sertifikat siswa magang sesuai data sistem</p>

    <table>
        <thead>
            <tr>
                <th style="width: 6%;">No</th>
                <th style="width: 35%;">Nama Siswa</th>
                <th style="width: 23%;">Nomor Sertifikat</th>
                <th style="width: 16%;">Tanggal Sertifikat</th>
                <th style="width: 15%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sertifikat as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nilaiPkl->magang->nama_siswa ?? '-' }}</td>
                    <td>{{ $item->nomor_sertifikat ?? '-' }}</td>
                    <td>
                        @if($item->tanggal_sertifikat)
                            {{ \Carbon\Carbon::parse($item->tanggal_sertifikat)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($item->file_sertifikat)
                            <span class="status-tersertifikat">Tersertifikat</span>
                        @else
                            <span class="status-belum">Belum Tersertifikat</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </footer>
</body>

</html>
