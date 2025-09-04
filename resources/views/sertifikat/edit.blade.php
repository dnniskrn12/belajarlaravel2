@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-certificate-outline"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Edit Sertifikat PKL</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Perbarui informasi sertifikat siswa</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
                        ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
                        ['label' => 'Sertifikat', 'route' => 'admin.sertifikat.index'],
                        ['label' => 'Edit Sertifikat'],
                    ]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="action-buttons">
                    <a href="{{ route('admin.sertifikat.index') }}" class="btn-filter">
                        <i class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Form Edit Sertifikat PKL</h3>
                <span class="form-subtitle">Perbarui detail sertifikat praktek kerja lapangan</span>
            </div>

            <div class="form-container-modern">
                <form action="{{ route('admin.sertifikat.update', $sertifikat->id) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Info Siswa -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-account-school"></i>
                            <h4>Informasi Siswa Magang</h4>
                        </div>
                        <div class="purple-card">
                            <div class="form-grid">
                                <div class="form-group-modern full-width">
                                    <label class="form-label-modern">
                                        <i class="mdi mdi-account-circle"></i>Nama Siswa
                                        <span class="readonly-badge">Read-only</span>
                                    </label>
                                    <input type="text" class="form-input-modern readonly"
                                        value="{{ $sertifikat->nilaiPkl->magang->nama_siswa }}" readonly>
                                    <input type="hidden" name="id_nilai_pkl" value="{{ $sertifikat->id_nilai_pkl }}">
                                </div>

                                <div class="form-group-modern full-width">
                                    <label class="form-label-modern">
                                        <i class="mdi mdi-numeric"></i>Nilai PKL
                                        <span class="readonly-badge">Read-only</span>
                                    </label>
                                    <input type="text" class="form-input-modern readonly"
                                        value="{{ $sertifikat->nilaiPkl->nilai_akhir }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Sertifikat -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-certificate"></i>
                            <h4>Detail Sertifikat</h4>
                        </div>
                        <div class="purple-card">
                            <div class="form-grid">
                                <div class="form-group-modern full-width">
                                    <label for="nomor_sertifikat" class="form-label-modern">
                                        <i class="mdi mdi-identifier"></i>
                                        Nomor Sertifikat
                                    </label>
                                    <input type="text" name="nomor_sertifikat" id="nomor_sertifikat"
                                        class="form-input-modern @error('nomor_sertifikat') error @enderror"
                                        value="{{ old('nomor_sertifikat', $sertifikat->nomor_sertifikat) }}">
                                    @error('nomor_sertifikat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group-modern full-width">
                                    <label for="tanggal_sertifikat" class="form-label-modern">
                                        <i class="mdi mdi-calendar"></i>
                                        Tanggal Sertifikat
                                    </label>
                                    <input type="date" name="tanggal_sertifikat" id="tanggal_sertifikat"
                                        class="form-input-modern @error('tanggal_sertifikat') error @enderror"
                                        value="{{ old('tanggal_sertifikat', $sertifikat->tanggal_sertifikat) }}">
                                    @error('tanggal_sertifikat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions" style="margin-top: 24px;">
                        <a href="{{ route('admin.sertifikat.index') }}" class="btn-cancel">
                            <i class="mdi mdi-close"></i> Batal
                        </a>
                        <button type="submit" class="btn-submit bg-gradient-primary">
                            <i class="mdi mdi-content-save"></i> Update Sertifikat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
