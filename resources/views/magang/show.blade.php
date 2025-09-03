
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
                        <h1 class="page-title-modern" style="margin:0;">Detail Magang</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Informasi lengkap {{ $magang->nama_siswa }}</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'route' => 'home'],
            ['label' => 'Magang', 'route' => 'admin.magang.index'],
            ['label' => 'Detail', 'route' => ['admin.magang.show', $magang->id]],
        ]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="action-buttons">
                    <a href="{{ route('admin.magang.index') }}" class="btn-filter">
                        <i class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                    <a href="{{ route('admin.magang.edit', $magang->id) }}" class="btn-add-modern bg-gradient-primary">
                        <i class="mdi mdi-pencil"></i>
                        Edit Data
                    </a>
                </div>
            </div>
        </div>

        <!-- Employee Profile Card -->
        <div class="employee-profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    @if($magang->foto)
                        <img src="{{ asset('storage/' . $magang->foto) }}"
                            alt="Foto {{ $magang->nama_siswa }}">
                    @else
                        <div class="avatar-placeholder">
                            {{ strtoupper(substr($magang->nama_siswa, 0, 1)) }}
                        </div>
                    @endif

                </div>
                <div class="profile-info">
                    <h2 class="profile-name">{{ $magang->nama_siswa }}</h2>
                    <p class="profile-id">{{ $magang->no_magang }}</p>
                    <div class="profile-status">
                        <span
                            class="status-badge {{ $magang->status_magang == 'Aktif' ? 'status-active' : 'status-inactive' }}">
                            <i
                                class="mdi {{ $magang->status_magang == 'Aktif' ? 'mdi-check-circle' : 'mdi-close-circle' }}"></i>
                            {{ $magang->status_magang }}
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
                        <div class="detail-value">{{ $magang->tempat_lahir ?? '-' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-calendar"></i>
                            Tanggal Lahir
                        </div>
                        <div class="detail-value">
                            {{ $magang->tgl_lahir ? date('d M Y', strtotime($magang->tgl_lahir)) : '-' }}
                            @if($magang->tgl_lahir)
                                <small class="age-info">
                                    ({{ \Carbon\Carbon::parse($magang->tgl_lahir)->age }} tahun)
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
                            <span class="gender-badge {{ strtolower($magang->jenis_kelamin) }}">
                                <i
                                    class="mdi {{ $magang->jenis_kelamin == 'Laki-laki' ? 'mdi-gender-male' : 'mdi-gender-female' }}"></i>
                                {{ $magang->jenis_kelamin }}
                            </span>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-book-open-variant"></i>
                            Agama
                        </div>
                        <div class="detail-value">{{ $magang->agama ?? '-' }}</div>
                    </div>
                    <div class="detail-row full-width">
                        <div class="detail-label">
                            <i class="mdi mdi-home"></i>
                            Alamat
                        </div>
                        <div class="detail-value">{{ $magang->alamat ?? '-' }}</div>
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
                            @if($magang->no_hp)
                                <a href="tel:{{ $magang->no_hp }}" class="contact-link">
                                    {{ $magang->no_hp }}
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
                            @if($magang->email)
                                <a href="mailto:{{ $magang->email }}" class="contact-link">
                                    {{ $magang->email }}
                                </a>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Education Information -->
            @if($magang->pend_magang->count() > 0)
                <div class="detail-card full-width">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">
                            <i class="mdi mdi-school"></i>
                        </div>
                        <h3>Riwayat Pendidikan</h3>
                    </div>
                    <div class="detail-card-content">
                        @foreach($magang->pend_magang as $i => $pend)
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
                    <h3>Informasi Magang</h3>
                </div>
                <div class="detail-card-content">
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-calendar-check"></i>
                            Tanggal Masuk
                        </div>
                        <div class="detail-value">
                            {{ $magang->tgl_masuk ? date('d M Y', strtotime($magang->tgl_masuk)) : '-' }}
                        </div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-calendar-remove"></i>
                            Tanggal Akhir
                        </div>
                        <div class="detail-value">
                            {{ $magang->tgl_akhir ? date('d M Y', strtotime($magang->tgl_akhir)) : '-' }}
                        </div>
                    </div>

                    {{-- 🔹 Lama Magang --}}
                    @if($magang->tgl_masuk)
                        @php
                            $start = \Carbon\Carbon::parse($magang->tgl_masuk);
                            $end = $magang->tgl_akhir ? \Carbon\Carbon::parse($magang->tgl_akhir) : now();
                            $diff = $start->diff($end); // hasilnya DateInterval
                        @endphp
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="mdi mdi-timer"></i>
                                Lama Magang
                            </div>
                            <div class="detail-value">
                                {{ $diff->y }} tahun {{ $diff->m }} bulan {{ $diff->d }} hari
                            </div>
                        </div>
                    @endif

                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="mdi mdi-account-check"></i>
                            Status Magang
                        </div>
                        <div class="detail-value">
                            <span
                                class="status-badge {{ $magang->status_magang == 'Aktif' ? 'status-active' : 'status-inactive' }}">
                                <i
                                    class="mdi {{ $magang->status_magang == 'Aktif' ? 'mdi-check-circle' : 'mdi-close-circle' }}"></i>
                                {{ $magang->status_magang }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Photo Section -->
            @if($magang->foto)
                <div class="detail-card photo-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">
                            <i class="mdi mdi-camera"></i>
                        </div>
                        <h3>Foto Magang</h3>
                    </div>
                    <div class="detail-card-content">
                        <div class="photo-container">
                            <img src="{{ asset('storage/' . $magang->foto) }}"
                                alt="Foto {{ $magang->nama_siswa }}">
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
    @if($magang->foto)
        <div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content modern-modal">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="mdi mdi-account-circle me-2"></i>
                            {{ $magang->nama_siswa }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/' . $magang->foto) }}" alt="Foto {{ $magang->nama_siswa }}"
                            class="modal-photo">
                        <div class="modal-photo-info">
                            <h6>{{ $magang->nama_siswa }}</h6>
                            <small>{{ $magang->no_magang }}</small>
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
