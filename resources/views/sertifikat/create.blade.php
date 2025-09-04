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
                        <h1 class="page-title-modern" style="margin:0;">Tambah Sertifikat PKL</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Buat sertifikat untuk siswa yang sudah lulus PKL
                        </p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
            ['label' => 'Sertifikat', 'route' => 'admin.sertifikat.index'],
            ['label' => 'Tambah Sertifikat', 'route' => 'admin.sertifikat.create'],
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
                <h3 class="card-title-clean">Form Input Sertifikat PKL</h3>
                <span class="form-subtitle">Lengkapi informasi sertifikat praktek kerja lapangan</span>
            </div>

            <div class="form-container-modern">
                <form action="{{ route('admin.sertifikat.store') }}" method="POST" novalidate>
                    @csrf

                    <!-- Pilih Siswa PKL -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-account-school"></i>
                            <h4>Pilih Siswa Magang</h4>
                        </div>
                        <div class="purple-card">
                            <div class="form-grid">
                                <div class="form-group-modern full-width">
                                    <label for="id_nilai_pkl" class="form-label-modern">
                                        <i class="mdi mdi-account-circle"></i>
                                        Siswa Magang (Nilai ≥ 70)
                                        <span class="required">*</span>
                                    </label>
                                    <select name="id_nilai_pkl" id="id_nilai_pkl"
                                        class="form-input-modern @error('id_nilai_pkl') error @enderror" required>
                                        <option value="">-- Pilih Siswa Magang --</option>
                                        @foreach($nilaiPklTersedia as $nilai)
                                            <option value="{{ $nilai->id }}" data-nama="{{ $nilai->magang->nama_siswa }}"
                                                data-nilai="{{ $nilai->nilai_akhir }}" {{ old('id_nilai_pkl') == $nilai->id ? 'selected' : '' }}>
                                                {{ $nilai->magang->nama_siswa }} - Nilai: {{ $nilai->nilai_akhir }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('id_nilai_pkl')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <div class="selected-student-info" id="selectedStudentInfo"
                                        style="display:none; margin-top: 16px;">
                                        <div class="student-card">
                                            <div class="student-card-header">
                                                <div class="student-avatar-large">
                                                    <span id="studentInitial"></span>
                                                </div>
                                                <div class="student-info-detail">
                                                    <h4 id="studentName"></h4>
                                                    <div class="student-grade">
                                                        <span class="grade-label">Nilai PKL:</span>
                                                        <span class="grade-value" id="studentGrade"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                    <div style="display:flex; gap:8px;">
                                        <input type="text" name="nomor_sertifikat" id="nomor_sertifikat"
                                            class="form-input-modern @error('nomor_sertifikat') error @enderror"
                                            value="{{ old('nomor_sertifikat') }}" placeholder="Contoh: SERTIF/PKL/2024/001">
                                        <button type="button" id="generateNomor" class="btn-filter" style="height: 38px;">
                                            <i class="mdi mdi-auto-fix"></i> Generate
                                        </button>
                                    </div>
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
                                        value="{{ old('tanggal_sertifikat', date('Y-m-d')) }}">
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
                            <i class="mdi mdi-content-save"></i> Simpan Sertifikat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const selectNilaiPkl = document.getElementById('id_nilai_pkl');
        const selectedStudentInfo = document.getElementById('selectedStudentInfo');
        const studentInitial = document.getElementById('studentInitial');
        const studentName = document.getElementById('studentName');
        const studentGrade = document.getElementById('studentGrade');
        const nomorInput = document.getElementById('nomor_sertifikat');
        const generateBtn = document.getElementById('generateNomor');

        selectNilaiPkl.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            if (this.value) {
                const nama = selectedOption.getAttribute('data-nama');
                const nilai = selectedOption.getAttribute('data-nilai');
                studentName.textContent = nama;
                studentGrade.textContent = nilai;
                selectedStudentInfo.style.display = 'block';
            } else {
                selectedStudentInfo.style.display = 'none';
            }
        });

        generateBtn.addEventListener('click', function () {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            nomorInput.value = `SERTIF/PKL/${year}/${month}${random}`;
            nomorInput.classList.add('highlight');
            setTimeout(() => nomorInput.classList.remove('highlight'), 1000);
        });

        // Trigger change jika ada old value
        if (selectNilaiPkl.value) {
            selectNilaiPkl.dispatchEvent(new Event('change'));
        }
    </script>

    <style>
        .highlight {
            animation: highlightAnim 1s ease;
        }

        @keyframes highlightAnim {
            0% {
                background-color: #eed7f7;
            }

            50% {
                background-color: #dc8cff;
            }

            100% {
                background-color: #eccdff;
            }
        }
    </style>
@endsection
