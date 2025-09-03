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
                        <h1 class="page-title-modern" style="margin:0;">Tambah SK Magang</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Tambah data SK Siswa Magang baru</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
            ['label' => 'SK Magang', 'route' => 'admin.sksiswa.index'],
            ['label' => 'Tambah', 'route' => 'admin.sksiswa.create'],
        ]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="action-buttons">
                    <a href="{{ route('admin.sksiswa.index') }}" class="btn-filter">
                        <i class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Form Data SK Magang</h3>
                <span class="form-subtitle">Lengkapi semua informasi SK Siswa Magang</span>
            </div>

            <div class="form-container-modern">
                <form action="{{ route('admin.sksiswa.store') }}" method="POST" novalidate>
                    @csrf

                    {{-- Informasi SK Magang --}}
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-file-account"></i>
                            <h4>Informasi SK Magang</h4>
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

                                <!-- Magang -->
                                <div class="form-group-modern">
                                    <label for="no_magang" class="form-label-modern">
                                        <i class="mdi mdi-account"></i> Magang <span class="required">*</span>
                                    </label>
                                    <select name="no_magang" id="no_magang"
                                        class="form-input-modern @error('no_magang') error @enderror" required>
                                        <option value="">-- Pilih Nama Siswa Magang --</option>
                                        @foreach($magang as $p)
                                            <option value="{{ $p->no_magang }}" {{ old('no_magang') == $p->no_magang ? 'selected' : '' }}>
                                                {{ $p->no_magang }} - {{ $p->nama_siswa }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('no_magang') <small class="text-danger">{{ $message }}</small> @enderror
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

                                <!-- Unit Magang -->
                                <div class="form-group-modern">
                                    <label for="id_unitmagang" class="form-label-modern">
                                        <i class="mdi mdi-office-building"></i> Unit Magang <span class="required">*</span>
                                    </label>
                                    <select name="id_unitmagang" id="id_unitmagang"
                                        class="form-input-modern @error('id_unitmagang') error @enderror" required>
                                        <option value="">-- Pilih Unit Magang --</option>
                                        @foreach($unitmagang as $u)
                                            <option value="{{ $u->id }}" {{ old('id_unitmagang') == $u->id ? 'selected' : '' }}>
                                                {{ $u->nama_unitmagang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_unitmagang') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="form-actions">
                        <a href="{{ route('admin.sksiswa.index') }}" class="btn-cancel">
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
