@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-account-plus"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Tambah Pegawai</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Tambah data pegawai baru</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
                        ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
                        ['label' => 'Pegawai', 'route' => 'admin.pegawai.index'],
                        ['label' => 'Tambah', 'route' => 'admin.pegawai.create'],
                    ]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="action-buttons">
                    <a href="{{ route('admin.pegawai.index') }}" class="btn-filter">
                        <i class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Form Data Pegawai</h3>
                <span class="form-subtitle">Lengkapi semua informasi pegawai</span>
            </div>

            <div class="form-container-modern">
                <form action="{{ route('admin.pegawai.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-account"></i>
                            <h4>Informasi Personal</h4>
                        </div>
                        <div class="purple-card">

                            <div class="form-grid">
                                <div class="form-group-modern">
                                    <label for="no_pegawai" class="form-label-modern">
                                        <i class="mdi mdi-identifier"></i>
                                        Nomor Pegawai
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="no_pegawai" id="no_pegawai"
                                        class="form-input-modern @error('no_pegawai') error @enderror"
                                        value="{{ old('no_pegawai') }}" placeholder="Masukkan nomor pegawai" required>
                                    @error('no_pegawai')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="nama_pegawai" class="form-label-modern">
                                        <i class="mdi mdi-account-outline"></i>
                                        Nama Lengkap
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="nama_pegawai" id="nama_pegawai"
                                        class="form-input-modern @error('nama_pegawai') error @enderror"
                                        value="{{ old('nama_pegawai') }}" placeholder="Masukkan nama lengkap" required>
                                    @error('nama_pegawai')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="tempat_lahir" class="form-label-modern">
                                        <i class="mdi mdi-map-marker"></i>
                                        Tempat Lahir
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir"
                                        class="form-input-modern @error('tempat_lahir') error @enderror"
                                        value="{{ old('tempat_lahir') }}" placeholder="Masukkan tempat lahir" required>
                                    @error('tempat_lahir')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="tgl_lahir" class="form-label-modern">
                                        <i class="mdi mdi-calendar"></i>
                                        Tanggal Lahir
                                        <span class="required">*</span>
                                    </label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir"
                                        class="form-input-modern @error('tgl_lahir') error @enderror"
                                        value="{{ old('tgl_lahir') }}" required>
                                    @error('tgl_lahir')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="jenis_kelamin" class="form-label-modern">
                                        <i class="mdi mdi-gender-male-female"></i>
                                        Jenis Kelamin
                                        <span class="required">*</span>
                                    </label>
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-select-modern @error('jenis_kelamin') error @enderror" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="agama" class="form-label-modern">
                                        <i class="mdi mdi-book-open-variant"></i>
                                        Agama
                                        <span class="required">*</span>
                                    </label>
                                    <select name="agama" id="agama"
                                        class="form-input-modern @error('agama') error @enderror" required>
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen Protestan" {{ old('agama') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan
                                        </option>
                                        <option value="Katholik" {{ old('agama') == 'Katholik' ? 'selected' : '' }}>Katholik
                                        </option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                        </option>
                                    </select>
                                    @error('agama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group-modern full-width">
                                <label for="alamat" class="form-label-modern">
                                    <i class="mdi mdi-home"></i>
                                    Alamat
                                    <span class="required">*</span>
                                </label>
                                <textarea name="alamat" id="alamat"
                                    class="form-textarea-modern @error('alamat') error @enderror"
                                    placeholder="Masukkan alamat lengkap" rows="3" required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-phone"></i>
                            <h4>Informasi Kontak</h4>
                        </div>
                        <div class="purple-card">
                            <div class="form-grid">
                                <div class="form-group-modern">
                                    <label for="no_hp" class="form-label-modern">
                                        <i class="mdi mdi-cellphone"></i>
                                        No HP
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="no_hp" id="no_hp"
                                        class="form-input-modern @error('no_hp') error @enderror" value="{{ old('no_hp') }}"
                                        placeholder="Masukkan nomor HP" required>
                                    @error('no_hp')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="email" class="form-label-modern">
                                        <i class="mdi mdi-email"></i>
                                        Email
                                        <span class="required">*</span>
                                    </label>
                                    <input type="email" name="email" id="email"
                                        class="form-input-modern @error('email') error @enderror" value="{{ old('email') }}"
                                        placeholder="Masukkan alamat email" required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Education Information Section -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-school"></i>
                            <h4>Informasi Pendidikan</h4>
                        </div>

                        <!-- Wrapper Pendidikan -->
                        <div id="pendidikan-wrapper" class="education-wrapper">
                            <div class="education-item">
                                <div class="purple-card">
                                    <div class="education-card-header">
                                        <div class="education-number">
                                            <i class="mdi mdi-numeric-1-circle"></i>
                                            <span>Pendidikan 1</span>
                                        </div>
                                        <button type="button" class="btn-remove-education" data-tooltip="Hapus Pendidikan">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </div>

                                    <div class="form-grid">
                                        <div class="form-group-modern">
                                            <label class="form-label-modern">
                                                <i class="mdi mdi-school-outline"></i>
                                                Jenjang Pendidikan
                                                <span class="required">*</span>
                                            </label>
                                            <select name="pendidikan[0][id_jjg]" class="form-select-modern" required>
                                                <option value="">-- Pilih Jenjang Pendidikan --</option>
                                                @foreach($jenjang as $jjg)
                                                    <option value="{{ $jjg->id_jjg }}">{{ $jjg->nama_jenjang }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group-modern">
                                            <label class="form-label-modern">
                                                <i class="mdi mdi-domain"></i>
                                                Nama Institusi
                                                <span class="required">*</span>
                                            </label>
                                            <input type="text" name="pendidikan[0][nama_pend]" class="form-input-modern"
                                                placeholder="Nama Sekolah / Universitas / Institut" required>
                                        </div>

                                        <div class="form-group-modern">
                                            <label class="form-label-modern">
                                                <i class="mdi mdi-calendar-range"></i>
                                                Tahun Pendidikan
                                                <span class="required">*</span>
                                            </label>
                                            <input type="number" name="pendidikan[0][thn_pend]" class="form-input-modern"
                                                placeholder="Contoh: 2010" min="1980" max="2030" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Tambah Pendidikan -->
                            <div class="add-education-container">
                                <button type="button" class="btn-add-education" id="add-pendidikan">
                                    <i class="mdi mdi-plus-circle"></i>
                                    <span>Tambah Pendidikan</span>
                                </button>
                                <p class="add-education-hint">Tambahkan riwayat pendidikan dari yang terbaru</p>
                            </div>
                        </div>
                    </div>
                    <div id="jenjang-options" style="display:none;">
                        <option value="">-- Pilih Jenjang Pendidikan --</option>
                        @foreach($jenjang as $jjg)
                            <option value="{{ $jjg->id_jjg }}">{{ $jjg->nama_jenjang }}</option>
                        @endforeach
                    </div>
                    <!-- Employment Information Section -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-briefcase"></i>
                            <h4>Informasi Pekerjaan</h4>
                        </div>
                        <div class="purple-card">

                            <div class="form-grid">
                                <div class="form-group-modern">
                                    <label for="status_kwn" class="form-label-modern">
                                        <i class="mdi mdi-heart"></i>
                                        Status Perkawinan
                                        <span class="required">*</span>
                                    </label>
                                    <select name="status_kwn" id="status_kwn"
                                        class="form-select-modern @error('status_kwn') error @enderror" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Menikah" {{ old('status_kwn') == 'Menikah' ? 'selected' : '' }}>
                                            Menikah
                                        </option>
                                        <option value="Belum Menikah" {{ old('status_kwn') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    </select>
                                    @error('status_kwn')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="status_pekerjaan" class="form-label-modern">
                                        <i class="mdi mdi-account-check"></i>
                                        Status Pekerjaan
                                        <span class="required">*</span>
                                    </label>
                                    <select name="status_pekerjaan" id="status_pekerjaan"
                                        class="form-select-modern @error('status_pekerjaan') error @enderror" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Aktif" {{ old('status_pekerjaan') == 'Aktif' ? 'selected' : '' }}>
                                            Aktif
                                        </option>
                                        <option value="Non Aktif" {{ old('status_pekerjaan') == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                                    </select>
                                    @error('status_pekerjaan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="tgl_masuk" class="form-label-modern">
                                        <i class="mdi mdi-calendar-check"></i>
                                        Tanggal Masuk
                                        <span class="required">*</span>
                                    </label>
                                    <input type="date" name="tgl_masuk" id="tgl_masuk"
                                        class="form-input-modern @error('tgl_masuk') error @enderror"
                                        value="{{ old('tgl_masuk') }}" required>
                                    @error('tgl_masuk')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="tgl_akhir" class="form-label-modern">
                                        <i class="mdi mdi-calendar-remove"></i>
                                        Tanggal Akhir
                                    </label>
                                    <input type="date" name="tgl_akhir" id="tgl_akhir"
                                        class="form-input-modern @error('tgl_akhir') error @enderror"
                                        value="{{ old('tgl_akhir') }}">

                                </div>

                                <div class="form-group-modern">
                                    <label for="foto" class="form-label-modern">
                                        <i class="mdi mdi-camera"></i>
                                        Foto Pegawai
                                        <span class="required">*</span>
                                    </label>

                                    <!-- Tempat preview foto -->
                                    <div class="foto-preview mb-2 text-center">
                                        <img id="preview-foto"
                                            src="{{ old('foto') ? asset('storage/foto_pegawai/' . old('foto')) : asset('template/dist/assets/images/default.png') }}"
                                            alt="Preview Foto"
                                            style="max-height:150px; width:auto; border:1px solid #ccc; padding:5px;">
                                    </div>
                                    <div class="file-upload-modern">
                                        <input type="file" name="foto" id="foto"
                                            class="file-input-modern @error('foto') error @enderror" accept="image/*">
                                        <label for="foto" class="file-label-modern">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <span>Pilih foto atau drag & drop</span>
                                            <small>Format: JPG, PNG, GIF (Max: 2MB)</small>
                                        </label>
                                    </div>
                                    @error('foto')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <a href="{{ route('admin.pegawai.index') }}" class="btn-cancel">
                            <i class="mdi mdi-close"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn-submit bg-gradient-primary">
                            <i class="mdi mdi-content-save"></i>
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
