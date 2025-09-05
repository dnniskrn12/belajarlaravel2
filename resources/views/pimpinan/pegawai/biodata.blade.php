<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Pegawai - {{ $pegawai->nama_pegawai }}</title>
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

        /* Header */
        .header {
    display: flex;
    justify-content: space-between;
    border-bottom: 3px solid #000000;
    padding-bottom: 3px;   /* kecilkan padding bawah */
    margin-bottom: 4px;    /* kecilkan jarak bawah */
}



        .header-info h1 {
            font-size: 18px;
            margin: 0 0 4px 0;
        }

        .header-info p {
            margin: 2px 0;
            font-size: 12px;
            color: #4b5563;
        }

        .report-meta {
            text-align: right;
            font-size: 12px;
            color: #4b5563;
        }

        .report-meta .date {
            color: #cbadff;
            font-weight: 600;
        }

        /* Title */
        .report-title {
            text-align: center;
            margin-bottom: 10px;
        }

        .report-title h2 {
            font-size: 20px;
            color: #000000;
            margin: 5px 0 0 0;
        }

        /* Profile */
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

        .profile-info p {
            margin: 0 0 8px 0;
            font-size: 13px;
            color: #4b5563;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: white;
        }

        .status-active {
            background: #16a34a;
        }

        .status-inactive {
            background: #b91c1c;
        }

        /* Sections */
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

        .section-content {
            padding: 12px 15px;
            background: #fff;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: 600;
            color: #374151;
        }

        .info-value {
            color: #1f2937;
            text-align: right;
        }

        .education-list {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .education-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .education-item:last-child {
            margin-bottom: 0;
        }

        /* Badges */
        .gender-badge.laki-laki {
            background: #dbeafe;
            color: #1e40af;
            padding: 3px 8px;
            border-radius: 12px;
        }

        .gender-badge.perempuan {
            background: #fce7f3;
            color: #be185d;
            padding: 3px 8px;
            border-radius: 12px;
        }

        .marriage-badge.menikah {
            background: #ecfdf5;
            color: #065f46;
            padding: 3px 8px;
            border-radius: 12px;
        }

        .marriage-badge.belum-menikah {
            background: #f3f4f6;
            color: #374151;
            padding: 3px 8px;
            border-radius: 12px;
        }

        /* Footer */
        .report-footer {
            margin-top: 35px;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
            font-size: 12px;
            color: #4b5563;
        }

        .signature {
            text-align: center;
        }

        .signature .name {
            margin-top: 60px;
            border-top: 1px solid #d1d5db;
            display: inline-block;
            padding-top: 4px;
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
    </div>
    <!-- Title -->
    <div class="report-title">
        <h2>Biodata Pegawai</h2>
    </div>

    <!-- Profile -->
    <div class="employee-profile">
        <div class="photo-container">
            @if($pegawai->foto)
                <img src="{{ public_path('storage/foto_pegawai/' . $pegawai->foto) }}"
                    alt="Foto {{ $pegawai->nama_pegawai }}">
            @else
                <span style="font-size: 40px; color:#9CA3AF;">📷</span>
            @endif
        </div>
        <div class="profile-info">
            <h3>{{ $pegawai->nama_pegawai }}</h3>
            <p>No. Pegawai: {{ $pegawai->no_pegawai }}</p>
            <span
                class="status-badge {{ $pegawai->status_pekerjaan == 'Aktif' ? 'status-active' : 'status-inactive' }}">
                {{ $pegawai->status_pekerjaan }}
            </span>
        </div>
    </div>

    <!-- Personal Info -->
    <div class="info-section">
        <div class="section-header">Informasi Personal</div>
        <div class="section-content">
            <div class="info-row">
                <div class="info-label">Tempat Lahir</div>
                <div class="info-value">{{ $pegawai->tempat_lahir ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Lahir</div>
                <div class="info-value">{{ $pegawai->tgl_lahir ? date('d M Y', strtotime($pegawai->tgl_lahir)) : '-' }}
                    @if($pegawai->tgl_lahir) ({{ \Carbon\Carbon::parse($pegawai->tgl_lahir)->age }} th) @endif</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jenis Kelamin</div>
                <div class="info-value"><span
                        class="gender-badge {{ strtolower($pegawai->jenis_kelamin) }}">{{ $pegawai->jenis_kelamin }}</span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Agama</div>
                <div class="info-value">{{ $pegawai->agama ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Alamat</div>
                <div class="info-value">{{ $pegawai->alamat ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- Contact Info -->
    <div class="info-section">
        <div class="section-header">Informasi Kontak</div>
        <div class="section-content">
            <div class="info-row">
                <div class="info-label">No HP</div>
                <div class="info-value">{{ $pegawai->no_hp ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email</div>
                <div class="info-value">{{ $pegawai->email ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- Education -->
    @if($pegawai->pend_pegawai->count() > 0)
        <div class="info-section">
            <div class="section-header">Riwayat Pendidikan</div>
            <div class="section-content">
                <ul class="education-list">
                    @foreach($pegawai->pend_pegawai as $pend)
                        <div class="info-row">
                            <div class="info-label">{{ $pend->nama_pend ?? '-' }}</div>
                            <div class="info-value">Tahun Lulus {{ $pend->thn_pend ?? '-' }}</div>
                        </div>
                        {{-- <li class="education-item"><span></span><span></span></li> --}}
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Employment Info -->
    <div class="info-section">
        <div class="section-header">Informasi Pekerjaan</div>
        <div class="section-content">
            <div class="info-row">
                <div class="info-label">Status Perkawinan</div>
                <div class="info-value"><span
                        class="marriage-badge {{ strtolower(str_replace(' ', '-', $pegawai->status_kwn ?? '')) }}">{{ $pegawai->status_kwn ?? '-' }}</span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Masuk</div>
                <div class="info-value">{{ $pegawai->tgl_masuk ? date('d M Y', strtotime($pegawai->tgl_masuk)) : '-' }}
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Akhir</div>
                <div class="info-value">{{ $pegawai->tgl_akhir ? date('d M Y', strtotime($pegawai->tgl_akhir)) : '-' }}
                </div>
            </div>
            @if($pegawai->tgl_masuk)
                @php
                    $start = \Carbon\Carbon::parse($pegawai->tgl_masuk);
                    $end = $pegawai->tgl_akhir ? \Carbon\Carbon::parse($pegawai->tgl_akhir) : now();
                    $diff = $start->diff($end);
                  @endphp
                <div class="info-row">
                    <div class="info-label">Lama Bekerja</div>
                    <div class="info-value">{{ $diff->y }} th {{ $diff->m }} bln {{ $diff->d }} hr</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <div class="report-footer">
        <div>
            Dinas Komunikasi dan Informatika Kota Kediri<br>
            Cetak: {{ date('d M Y') }}
        </div>
    </div>
    </div>
</body>

</html>
