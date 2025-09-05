<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Laporan Data Magang</title>
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
            color: #000000;
            margin-bottom: 2px;
            font-size: 18pt;
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
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #d1d5db;
            padding: 10px 14px;
            text-align: left;
            word-wrap: break-word;
        }
        th {
            background-color: #6366f1;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 10pt;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .status-active {
            color: #166534;
            background: #dcfce7;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 9pt;
            display: inline-block;
        }
        .status-inactive {
            color: #b45309;
            background: #fef3c7;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 9pt;
            display: inline-block;
        }
        footer {
            text-align: center;
            font-size: 10.5pt;
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
    <div class="report-container">
        <!-- Kop Surat -->
        <div class="header"
            style="display: flex; align-items: flex-start; border-bottom: 3px solid #000000; padding: 10px 0;">
            <div style="flex: 0 0 70px; text-align: center;">
                <img src="{{ public_path('storage/background/logo.png')}}" alt="Logo"
                    style="width: 50px; height: auto;">
            </div>
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
    </div>

    <h1 style="text-decoration: underline">LAPORAN DATA MAGANG</h1>
    <p class="subtitle">Daftar peserta magang beserta statusnya</p>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 24%;">Nama Siswa</th>
                <th style="width: 16%;">Nomor HP</th>
                <th style="width: 14%;">Tanggal Masuk</th>
                <th style="width: 14%;">Tanggal Keluar</th>
                <th style="width: 15%;">Lama Magang</th>
                <th style="width: 12%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($magang as $index => $m)
                @php
                    $start = \Carbon\Carbon::parse($m->tgl_masuk);
                    $end = $m->tgl_akhir ? \Carbon\Carbon::parse($m->tgl_akhir) : now();
                    $diff = $start->diff($end);
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $m->nama_siswa }}</td>
                    <td>{{ $m->no_hp }}</td>
                    <td>{{ $m->tgl_masuk ? date('d M Y', strtotime($m->tgl_masuk)) : '-' }}</td>
                    <td>{{ $m->tgl_akhir ? date('d M Y', strtotime($m->tgl_akhir)) : '-' }}</td>
                    <td>{{ $diff->y }} th {{ $diff->m }} bln {{ $diff->d }} hr</td>
                    <td>
                        @if($m->status_magang == 'Aktif')
                            <span class="status-active">Aktif</span>
                        @else
                            <span class="status-inactive">{{ $m->status_magang }}</span>
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
