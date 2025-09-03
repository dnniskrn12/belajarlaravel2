@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-file-document-plus"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Tambah SK Kerja</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Tambah data SK kerja baru</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'route' => 'home'],
            ['label' => 'SK Kerja', 'route' => 'admin.skkerja.index'],
            ['label' => 'Tambah', 'route' => 'admin.skkerja.create'],
        ]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="action-buttons">
                    <a href="{{ route('admin.skkerja.index') }}" class="btn-filter">
                        <i class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Form Data SK Kerja</h3>
                <span class="form-subtitle">Lengkapi semua informasi SK kerja</span>
            </div>

            <div class="form-container-modern">
                <form action="{{ route('admin.skkerja.store') }}" method="POST" novalidate>
                    @csrf

                    {{-- Informasi SK Kerja --}}
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-file-account"></i>
                            <h4>Informasi SK Kerja</h4>
                        </div>
                        <div class="purple-card">
                            <div class="form-grid">
                                <!-- Nomor SK -->
                                <div class="form-group-modern">
                                    <label for="no_sk" class="form-label-modern">
                                        <i class="mdi mdi-numeric"></i> Nomor SK <span class="required">*</span>
                                    </label>
                                    <input type="text" name="no_sk" id="no_sk"
                                        class="form-input-modern @error('no_sk') error @enderror" value="{{ old('no_sk') }}"
                                        placeholder="Masukkan nomor SK" required>
                                    @error('no_sk') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Pegawai -->
                                <div class="form-group-modern">
                                    <label for="no_pegawai" class="form-label-modern">
                                        <i class="mdi mdi-account"></i> Pegawai <span class="required">*</span>
                                    </label>
                                    <select name="no_pegawai" id="no_pegawai"
                                        class="form-input-modern @error('no_pegawai') error @enderror" required>
                                        <option value="">-- Pilih Pegawai --</option>
                                        @foreach($pegawai as $p)
                                            <option value="{{ $p->no_pegawai }}" {{ old('no_pegawai') == $p->no_pegawai ? 'selected' : '' }}>
                                                {{ $p->no_pegawai }} - {{ $p->nama_pegawai }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('no_pegawai') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>


                                <!-- Tanggal SK -->
                                <div class="form-group-modern">
                                    <label for="tgl_sk" class="form-label-modern">
                                        <i class="mdi mdi-calendar"></i> Tanggal SK <span class="required">*</span>
                                    </label>
                                    <input type="date" name="tgl_sk" id="tgl_sk"
                                        class="form-input-modern @error('tgl_sk') error @enderror"
                                        value="{{ old('tgl_sk') }}" required>
                                    @error('tgl_sk') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Jabatan -->
                                <div class="form-group-modern">
                                    <label for="id_jabatan" class="form-label-modern">
                                        <i class="mdi mdi-briefcase"></i> Jabatan <span class="required">*</span>
                                    </label>
                                    <select name="id_jabatan" id="id_jabatan"
                                        class="form-input-modern @error('id_jabatan') error @enderror" required>
                                        <option value="">-- Pilih Jabatan --</option>
                                        @foreach($jabatan as $j)
                                            <option value="{{ $j->id }}" {{ old('id_jabatan') == $j->id ? 'selected' : '' }}>
                                                {{ $j->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_jabatan') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Unit Kerja -->
                                <div class="form-group-modern">
                                    <label for="id_unitkerja" class="form-label-modern">
                                        <i class="mdi mdi-office-building"></i> Unit Kerja <span class="required">*</span>
                                    </label>
                                    <select name="id_unitkerja" id="id_unitkerja"
                                        class="form-input-modern @error('id_unitkerja') error @enderror" required>
                                        <option value="">-- Pilih Unit Kerja --</option>
                                        @foreach($unitkerja as $u)
                                            <option value="{{ $u->id }}" {{ old('id_unitkerja') == $u->id ? 'selected' : '' }}>
                                                {{ $u->nama_unitkerja }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_unitkerja') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Lokasi -->
                                <div class="form-group-modern">
                                    <label for="id_lokasi" class="form-label-modern">
                                        <i class="mdi mdi-map-marker"></i> Lokasi <span class="required">*</span>
                                    </label>
                                    <select name="id_lokasi" id="id_lokasi"
                                        class="form-input-modern @error('id_lokasi') error @enderror" required>
                                        <option value="">-- Pilih Lokasi --</option>
                                        @foreach($lokasi as $l)
                                            <option value="{{ $l->id }}" {{ old('id_lokasi') == $l->id ? 'selected' : '' }}>
                                                {{ $l->nama_lokasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_lokasi') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="form-actions">
                        <a href="{{ route('admin.skkerja.index') }}" class="btn-cancel">
                            <i class="mdi mdi-close"></i> Batal
                        </a>
                        <button type="submit" class="btn-submit bg-gradient-primary">
                            <i class="mdi mdi-content-save"></i> Simpan SK
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
