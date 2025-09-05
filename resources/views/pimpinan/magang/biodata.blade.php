<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Magang - {{ $magang->nama_siswa }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            color: #1f2937;
            background: #f9fafb;
            margin: 0;
            padding: 0;
        }
        .report-container {
            max-width: 21cm;
            margin: 20px auto;
            padding: 2cm;
            background: white;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.08);
            border-radius: 6px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 3px solid #000000;
            padding-bottom: 3px;
            margin-bottom: 4px;
        }
        .report-title {
            text-align: center;
            margin: 10px 0 15px 0;
        }
        .report-title h2 {
            font-size: 20px;
            color: #000000;
            margin: 0;
        }
        .employee-profile {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #fafafa;
        }
        .photo-container {
            width: 120px;
            height: 150px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            overflow: hidden;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .profile-info h3 {
            margin: 0 0 6px 0;
            font-size: 16px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: white;
        }
        .status-active { background: #16a34a; }
        .status-inactive { background: #b91c1c; }
        .info-section {
            margin-bottom: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }
        .section-header {
            background: #cbadff;
            color: white;
            padding: 10px 15px;
            font-weight: 600;
            font-size: 13px;
        }
        .section-content { padding: 12px 15px; background: #fff; }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .info-label { font-weight: 600; color: #374151; }
        .info-value { color: #1f2937; text-align: right; }
        .gender-badge.laki-laki {
            background: #dbeafe; color: #1e40af; padding: 3px 8px; border-radius: 12px;
        }
        .gender-badge.perempuan {
            background: #fce7f3; color: #be185d; padding: 3px 8px; border-radius: 12px;
        }
        .report-footer {
            margin-top: 35px;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
            font-size: 12px;
            color: #4b5563;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="report-container">
        <!-- Header -->
        <div class="header">
            <div style="flex: 0 0 70px; text-align: center;">
                <img src="{{ public_path('storage/background/logo.png')}}" alt="Logo"
                    style="width: 50px; height: auto;">
            </div>
            <div style="flex: 1; text-align: center; padding-top: 5px;">
                <h1 style="margin: 0; font-size: 18px; font-weight: 700; line-height: 1.4;">
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

        <!-- Title -->
        <div class="report-title">
            <h2>Biodata Magang</h2>
        </div>

        <!-- Profile -->
        <div class="employee-profile">
            <div class="photo-container">
                @if($magang->foto)
                    <img src="{{ public_path('storage/foto_magang/' . $magang->foto) }}"
                        alt="Foto {{ $magang->nama_siswa }}">
                @else
                    <span style="font-size: 40px; color:#9CA3AF;">📷</span>
                @endif
            </div>
            <div class="profile-info">
                <h3>{{ $magang->nama_siswa }}</h3>
                <p>No. Magang: {{ $magang->no_magang }}</p>
                <span class="status-badge {{ $magang->status_magang == 'Aktif' ? 'status-active' : 'status-inactive' }}">
                    {{ $magang->status_magang }}
                </span>
            </div>
        </div>

        <!-- Informasi Personal -->
        <div class="info-section">
            <div class="section-header">Informasi Personal</div>
            <div class="section-content">
                <div class="info-row">
                    <div class="info-label">Tempat Lahir</div>
                    <div class="info-value">{{ $magang->tempat_lahir ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Lahir</div>
                    <div class="info-value">
                        {{ $magang->tgl_lahir ? date('d M Y', strtotime($magang->tgl_lahir)) : '-' }}
                        @if($magang->tgl_lahir)
                            ({{ \Carbon\Carbon::parse($magang->tgl_lahir)->age }} th)
                        @endif
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jenis Kelamin</div>
                    <div class="info-value">
                        <span class="gender-badge {{ strtolower($magang->jenis_kelamin) }}">
                            {{ $magang->jenis_kelamin }}
                        </span>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Agama</div>
                    <div class="info-value">{{ $magang->agama ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Alamat</div>
                    <div class="info-value">{{ $magang->alamat ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="info-section">
            <div class="section-header">Informasi Kontak</div>
            <div class="section-content">
                <div class="info-row">
                    <div class="info-label">No HP</div>
                    <div class="info-value">{{ $magang->no_hp ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $magang->email ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Pendidikan -->
        @if($magang->pend_magang->count() > 0)
            <div class="info-section">
                <div class="section-header">Riwayat Pendidikan</div>
                <div class="section-content">
                    @foreach($magang->pend_magang as $pend)
                        <div class="info-row">
                            <div class="info-label">{{ $pend->nama_pend ?? '-' }}</div>
                            <div class="info-value">Tahun {{ $pend->thn_pend ?? '-' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Informasi Magang -->
        <div class="info-section">
            <div class="section-header">Informasi Magang</div>
            <div class="section-content">
                <div class="info-row">
                    <div class="info-label">Tanggal Masuk</div>
                    <div class="info-value">{{ $magang->tgl_masuk ? date('d M Y', strtotime($magang->tgl_masuk)) : '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Akhir</div>
                    <div class="info-value">{{ $magang->tgl_akhir ? date('d M Y', strtotime($magang->tgl_akhir)) : '-' }}</div>
                </div>
                @if($magang->tgl_masuk)
                    @php
                        $start = \Carbon\Carbon::parse($magang->tgl_masuk);
                        $end = $magang->tgl_akhir ? \Carbon\Carbon::parse($magang->tgl_akhir) : now();
                        $diff = $start->diff($end);
                    @endphp
                    <div class="info-row">
                        <div class="info-label">Lama Magang</div>
                        <div class="info-value">{{ $diff->y }} th {{ $diff->m }} bln {{ $diff->d }} hr</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="report-footer">
            Dinas Komunikasi dan Informatika Kota Kediri<br>
            Cetak: {{ date('d M Y') }}
        </div>
    </div>
</body>
</html>
