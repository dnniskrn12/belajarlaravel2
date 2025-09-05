
@extends('layouts.purple')

@section('content')

    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-account-details"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Detail Pegawai</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Informasi lengkap {{ $pegawai->nama_pegawai }}</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'route' => 'pimpinan.dashboard'],
            ['label' => 'Laporan Pegawai', 'route' => 'pimpinan.pegawai.index'],
            ['label' => 'Detail', 'route' => ['pimpinan.pegawai.show', $pegawai->id]],
        ]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="action-buttons">
                    <a href="{{ route('pimpinan.pegawai.index') }}" class="btn-filter">
                        <i class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Employee Profile Card -->
        <div class="employee-profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    @if($pegawai->foto)
                        <img src="{{ asset('storage/foto_pegawai/' . $pegawai->foto) }}"
                            alt="Foto {{ $pegawai->nama_pegawai }}">
                    @else
                        <div class="avatar-placeholder">
                            {{ strtoupper(substr($pegawai->nama_pegawai, 0, 1)) }}
                        </div>
                    @endif

                </div>
                <div class="profile-info">
                    <h2 class="profile-name">{{ $pegawai->nama_pegawai }}</h2>
                    <p class="profile-id">{{ $pegawai->no_pegawai }}</p>
                    <div class="profile-status">
                        <span
                            class="status-badge {{ $pegawai->status_pekerjaan == 'Aktif' ? 'status-active' : 'status-inactive' }}">
                            <i
                                class="mdi {{ $pegawai->status_pekerjaan == 'Aktif' ? 'mdi-check-circle' : 'mdi-close-circle' }}"></i>
                            {{ $pegawai->status_pekerjaan }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-grid">
            <!-- Personal Information -->
            <div class="detail-card">
                <div class="detail-card-header">
                    <div class="detail-card-icon">
                        <i class="mdi mdi-account"></i>
                    </div>
                    <h3>Informasi Personal</h3>
                </div>
                <div class="detail-card-content">
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-map-marker"></i>
                            Tempat Lahir
                        </div>
                        <div class="detail-value">{{ $pegawai->tempat_lahir ?? '-' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-calendar"></i>
                            Tanggal Lahir
                        </div>
                        <div class="detail-value">
                            {{ $pegawai->tgl_lahir ? date('d M Y', strtotime($pegawai->tgl_lahir)) : '-' }}
                            @if($pegawai->tgl_lahir)
                                <small class="age-info">
                                    ({{ \Carbon\Carbon::parse($pegawai->tgl_lahir)->age }} tahun)
                                </small>
                            @endif
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-gender-male-female"></i>
                            Jenis Kelamin
                        </div>
                        <div class="detail-value">
                            <span class="gender-badge {{ strtolower($pegawai->jenis_kelamin) }}">
                                <i
                                    class="mdi {{ $pegawai->jenis_kelamin == 'Laki-laki' ? 'mdi-gender-male' : 'mdi-gender-female' }}"></i>
                                {{ $pegawai->jenis_kelamin }}
                            </span>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-book-open-variant"></i>
                            Agama
                        </div>
                        <div class="detail-value">{{ $pegawai->agama ?? '-' }}</div>
                    </div>
                    <div class="detail-row full-width">
                        <div class="detail-label">
                            <i class="mdi mdi-home"></i>
                            Alamat
                        </div>
                        <div class="detail-value">{{ $pegawai->alamat ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="detail-card">
                <div class="detail-card-header">
                    <div class="detail-card-icon">
                        <i class="mdi mdi-phone"></i>
                    </div>
                    <h3>Informasi Kontak</h3>
                </div>
                <div class="detail-card-content">
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-cellphone"></i>
                            No HP
                        </div>
                        <div class="detail-value">
                            @if($pegawai->no_hp)
                                <a href="tel:{{ $pegawai->no_hp }}" class="contact-link">
                                    {{ $pegawai->no_hp }}
                                </a>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-email"></i>
                            Email
                        </div>
                        <div class="detail-value">
                            @if($pegawai->email)
                                <a href="mailto:{{ $pegawai->email }}" class="contact-link">
                                    {{ $pegawai->email }}
                                </a>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Education Information -->
            @if($pegawai->pend_pegawai->count() > 0)
                <div class="detail-card full-width">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">
                            <i class="mdi mdi-school"></i>
                        </div>
                        <h3>Riwayat Pendidikan</h3>
                    </div>
                    <div class="detail-card-content">
                        @foreach($pegawai->pend_pegawai as $i => $pend)
                            <div class="detail-row">
                                <div class="detail-label">
                                    <i class="mdi mdi-numeric-{{ $i + 1 }}-circle"></i>
                                    Pendidikan {{ $i + 1 }}
                                </div>
                                <div class="detail-value">
                                    <strong>{{ $pend->nama_pend ?? '-' }}</strong> <br>
                                    @if($pend->thn_pend)
                                        ({{ $pend->thn_pend }})
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Employment Information -->
            <div class="detail-card">
                <div class="detail-card-header">
                    <div class="detail-card-icon">
                        <i class="mdi mdi-briefcase"></i>
                    </div>
                    <h3>Informasi Pekerjaan</h3>
                </div>
                <div class="detail-card-content">
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-heart"></i>
                            Status Perkawinan
                        </div>
                        <div class="detail-value">
                            <span
                                class="marriage-badge {{ strtolower(str_replace(' ', '-', $pegawai->status_kwn ?? '')) }}">
                                <i
                                    class="mdi {{ $pegawai->status_kwn == 'Menikah' ? 'mdi-heart' : 'mdi-heart-outline' }}"></i>
                                {{ $pegawai->status_kwn ?? '-' }}
                            </span>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-calendar-check"></i>
                            Tanggal Masuk
                        </div>
                        <div class="detail-value">
                            {{ $pegawai->tgl_masuk ? date('d M Y', strtotime($pegawai->tgl_masuk)) : '-' }}
                        </div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-calendar-remove"></i>
                            Tanggal Akhir
                        </div>
                        <div class="detail-value">
                            {{ $pegawai->tgl_akhir ? date('d M Y', strtotime($pegawai->tgl_akhir)) : '-' }}
                        </div>
                    </div>

                    {{-- 🔹 Lama Bekerja --}}
                    @if($pegawai->tgl_masuk)
                        @php
                            $start = \Carbon\Carbon::parse($pegawai->tgl_masuk);
                            $end = $pegawai->tgl_akhir ? \Carbon\Carbon::parse($pegawai->tgl_akhir) : now();
                            $diff = $start->diff($end); // hasilnya DateInterval
                        @endphp
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="mdi mdi-timer"></i>
                                Lama Bekerja
                            </div>
                            <div class="detail-value">
                                {{ $diff->y }} tahun {{ $diff->m }} bulan {{ $diff->d }} hari
                            </div>
                        </div>
                    @endif

                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-account-check"></i>
                            Status Pekerjaan
                        </div>
                        <div class="detail-value">
                            <span
                                class="status-badge {{ $pegawai->status_pekerjaan == 'Aktif' ? 'status-active' : 'status-inactive' }}">
                                <i
                                    class="mdi {{ $pegawai->status_pekerjaan == 'Aktif' ? 'mdi-check-circle' : 'mdi-close-circle' }}"></i>
                                {{ $pegawai->status_pekerjaan }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Photo Section -->
            @if($pegawai->foto)
                <div class="detail-card photo-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">
                            <i class="mdi mdi-camera"></i>
                        </div>
                        <h3>Foto Pegawai</h3>
                    </div>
                    <div class="detail-card-content">
                        <div class="photo-container">
                            <img src="{{ asset('storage/foto_pegawai/' . $pegawai->foto) }}"
                                alt="Foto {{ $pegawai->nama_pegawai }}">
                            <div class="photo-overlay">
                                <button class="photo-zoom-btn" data-bs-toggle="modal" data-bs-target="#photoModal">
                                    <i class="mdi mdi-magnify-plus"></i>
                                    Lihat Besar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Photo Modal -->
    @if($pegawai->foto)
        <div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content modern-modal">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="mdi mdi-account-circle me-2"></i>
                            {{ $pegawai->nama_pegawai }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/foto_pegawai/' . $pegawai->foto) }}" alt="Foto {{ $pegawai->nama_pegawai }}"
                            class="modal-photo">
                        <div class="modal-photo-info">
                            <h6>{{ $pegawai->nama_pegawai }}</h6>
                            <small>{{ $pegawai->no_pegawai }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function () {
            // Add hover effects to detail cards
            const detailCards = document.querySelectorAll('.detail-card');
            detailCards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 8px 30px rgba(0, 0, 0, 0.1)';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.05)';
                });
            });
        });
    </script>
@endsection
