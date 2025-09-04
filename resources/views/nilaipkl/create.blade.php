@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-star-circle"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Tambah Nilai Magang</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Input nilai magang siswa</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
            ['label' => 'Nilai Magang', 'route' => 'admin.nilaipkl.index'],
            ['label' => 'Tambah Nilai', 'route' => 'admin.nilaipkl.create'],
        ]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="action-buttons">
                    <a href="{{ route('admin.nilaipkl.index') }}" class="btn-filter">
                        <i class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Form Input Nilai Magang</h3>
                <span class="form-subtitle">Lengkapi semua informasi penilaian Magang</span>
            </div>

            <div class="form-container-modern">
                <form action="{{ route('admin.nilaipkl.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf

                    <!-- Informasi Siswa -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-account"></i>
                            <h4>Informasi Siswa</h4>
                        </div>
                        <div class="purple-card">
                            <div class="form-grid">
                                <div class="form-group-modern full-width">
                                    <label for="nama_siswa" class="form-label-modern">
                                        <i class="mdi mdi-account-outline"></i>
                                        Nama Siswa
                                        <span class="required">*</span>
                                    </label>
                                    <select name="no_magang" id="no_magang"
                                        class="form-input-modern @error('no_magang') error @enderror" required>
                                        <option value="">-- Pilih Nama Siswa Magang --</option>
                                        @foreach($magang as $p)
                                            <option value="{{ $p->no_magang }}" {{ old('no_magang') == $p->no_magang ? 'selected' : '' }}> {{ $p->no_magang }} - {{ $p->nama_siswa }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nama_siswa')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Penilaian Magang -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-star"></i>
                            <h4>Penilaian Magang</h4>
                        </div>
                        <div class="purple-card">
                            <div class="form-grid">
                                <div class="form-group-modern">
                                    <label for="nilai_pkl" class="form-label-modern">
                                        <i class="mdi mdi-numeric"></i>
                                        Nilai Magang
                                        <span class="required">*</span>
                                    </label>
                                    <input type="number" name="nilai_pkl" id="nilai_pkl"
                                        class="form-input-modern @error('nilai_pkl') error @enderror"
                                        value="{{ old('nilai_pkl') }}" min="0" max="100" step="0.01"
                                        placeholder="Masukkan nilai 0-100" required>
                                    @error('nilai_pkl')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group-modern full-width">
                                    <label for="catatan" class="form-label-modern">
                                        <i class="mdi mdi-note-text"></i>
                                        Catatan Evaluasi
                                    </label>
                                    <textarea name="catatan" id="catatan" rows="4"
                                        class="form-textarea-modern @error('catatan') error @enderror"
                                        placeholder="Tuliskan catatan evaluasi, kelebihan, kekurangan, atau saran...">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload File -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-file-upload"></i>
                            <h4>Upload Dokumen Nilai</h4>
                        </div>
                        <div class="purple-card">
                            <div class="form-group-modern full-width">
                                <label for="file_scan_nilai" class="form-label-modern">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    File Scan Nilai Magang
                                </label>
                                <div class="file-upload-modern">
                                    <input type="file" name="file_scan_nilai" id="file_scan_nilai"
                                        class="file-input-modern @error('file_scan_nilai') error @enderror"
                                        accept=".jpg,.jpeg,.png,.pdf">
                                    <label for="file_scan_nilai" class="file-label-modern">
                                        <i class="mdi mdi-cloud-upload"></i>
                                        <span>Pilih file atau drag & drop</span>
                                        <small>Format: JPG, PNG, PDF (Max: 5MB)</small>
                                    </label>
                                </div>
                                @error('file_scan_nilai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="file-preview" id="filePreview" style="display: none;">
                        <div class="file-info">
                            <div class="file-icon"><i class="mdi mdi-file-document"></i></div>
                            <div class="file-details">
                                <div class="file-name" id="fileName"></div>
                                <div class="file-size" id="fileSize"></div>
                            </div>
                            <button type="button" class="file-remove" id="fileRemove">
                                <i class="mdi mdi-close"></i>
                            </button>
                        </div>
                        <!-- Tempat preview file -->
                        <div class="file-preview-content mt-2" id="filePreviewContent"></div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <a href="{{ route('admin.nilaipkl.index') }}" class="btn-cancel">
                            <i class="mdi mdi-close"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn-submit bg-gradient-primary">
                            <i class="mdi mdi-content-save"></i>
                            Simpan Nilai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('file_scan_nilai').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const filePreview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const filePreviewContent = document.getElementById('filePreviewContent');

            if (file) {
                fileName.textContent = file.name;
                fileSize.textContent = (file.size / 1024).toFixed(1) + ' KB';
                filePreview.style.display = 'block';

                // reset isi preview
                filePreviewContent.innerHTML = '';

                // cek jenis file
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.style.maxHeight = '200px';
                    img.style.border = '1px solid #ccc';
                    img.style.padding = '5px';
                    filePreviewContent.appendChild(img);
                } else if (file.type === 'application/pdf') {
                    const embed = document.createElement('embed');
                    embed.src = URL.createObjectURL(file);
                    embed.type = "application/pdf";
                    embed.width = "100%";
                    embed.height = "400px";
                    filePreviewContent.appendChild(embed);
                } else {
                    filePreviewContent.innerHTML = '<p class="text-muted">Preview tidak tersedia</p>';
                }
            } else {
                filePreview.style.display = 'none';
            }
        });

        document.getElementById('fileRemove').addEventListener('click', function () {
            document.getElementById('file_scan_nilai').value = '';
            document.getElementById('filePreview').style.display = 'none';
        });
    </script>

@endsection
