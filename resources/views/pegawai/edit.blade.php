@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-account-edit"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Edit Pegawai</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Ubah data pegawai {{ $pegawai->nama_pegawai }}</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'route' => 'home'],
            ['label' => 'Pegawai', 'route' => 'pegawai.index'],
            ['label' => 'Edit', 'route' => 'pegawai.edit'],
        ]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="action-buttons">
                    <a href="{{ route('pegawai.index') }}" class="btn-filter">
                        <i class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Form Edit Pegawai</h3>
                <span class="form-subtitle">Perbarui informasi pegawai</span>
            </div>

            <div class="form-container-modern">
                <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Section -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-account"></i>
                            <h4>Informasi Personal</h4>
                        </div>

                        <div class="form-grid">
                            <div class="form-group-modern">
                                <label for="no_pegawai" class="form-label-modern">
                                    <i class="mdi mdi-identifier"></i>
                                    Nomor Pegawai
                                    <span class="readonly-badge">Read-only</span>
                                </label>
                                <input type="text" name="no_pegawai" id="no_pegawai"
                                    class="form-input-modern readonly @error('no_pegawai') error @enderror"
                                    value="{{ $pegawai->no_pegawai }}" readonly>
                                @error('no_pegawai')
                                    <span class="form-error">{{ $message }}</span>
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
                                    value="{{ $pegawai->nama_pegawai }}" placeholder="Masukkan nama lengkap" required>
                                @error('nama_pegawai')
                                    <span class="form-error">{{ $message }}</span>
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
                                    value="{{ $pegawai->tempat_lahir }}" placeholder="Masukkan tempat lahir" required>
                                @error('tempat_lahir')
                                    <span class="form-error">{{ $message }}</span>
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
                                    value="{{ $pegawai->tgl_lahir }}" required>
                                @error('tgl_lahir')
                                    <span class="form-error">{{ $message }}</span>
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
                                    <option value="Laki-laki" {{ $pegawai->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan" {{ $pegawai->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group-modern">
                                <label for="agama" class="form-label-modern">
                                    <i class="mdi mdi-book-open-variant"></i>
                                    Agama
                                    <span class="required">*</span>
                                </label>
                                <input type="text" name="agama" id="agama"
                                    class="form-input-modern @error('agama') error @enderror" value="{{ $pegawai->agama }}"
                                    placeholder="Masukkan agama" required>
                                @error('agama')
                                    <span class="form-error">{{ $message }}</span>
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
                                placeholder="Masukkan alamat lengkap" rows="3" required>{{ $pegawai->alamat }}</textarea>
                            @error('alamat')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-phone"></i>
                            <h4>Informasi Kontak</h4>
                        </div>

                        <div class="form-grid">
                            <div class="form-group-modern">
                                <label for="no_hp" class="form-label-modern">
                                    <i class="mdi mdi-cellphone"></i>
                                    No HP
                                    <span class="required">*</span>
                                </label>
                                <input type="text" name="no_hp" id="no_hp"
                                    class="form-input-modern @error('no_hp') error @enderror" value="{{ $pegawai->no_hp }}"
                                    placeholder="Masukkan nomor HP" required>
                                @error('no_hp')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group-modern">
                                <label for="email" class="form-label-modern">
                                    <i class="mdi mdi-email"></i>
                                    Email
                                    <span class="required">*</span>
                                </label>
                                <input type="email" name="email" id="email"
                                    class="form-input-modern @error('email') error @enderror" value="{{ $pegawai->email }}"
                                    placeholder="Masukkan alamat email" required>
                                @error('email')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information Section -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-briefcase"></i>
                            <h4>Informasi Pekerjaan</h4>
                        </div>

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
                                    <option value="Menikah" {{ old('status_kwn', $pegawai->status_kwn) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Belum Menikah" {{ old('status_kwn', $pegawai->status_kwn) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                </select>
                                @error('status_kwn')
                                    <span class="form-error">{{ $message }}</span>
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
                                    <option value="Aktif" {{ $pegawai->status_pekerjaan == 'Aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="Non Aktif" {{ $pegawai->status_pekerjaan == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                                </select>
                                @error('status_pekerjaan')
                                    <span class="form-error">{{ $message }}</span>
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
                                    value="{{ $pegawai->tgl_masuk }}" required>
                                @error('tgl_masuk')
                                    <span class="form-error">{{ $message }}</span>
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
                                @error('tgl_akhir')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group-modern">
                                <label for="foto" class="form-label-modern">
                                    <i class="mdi mdi-camera"></i>
                                    Foto Pegawai
                                </label>
                                <div class="file-upload-modern">
                                    <input type="file" name="foto" id="foto"
                                        class="file-input-modern @error('foto') error @enderror" accept="image/*">
                                    <label for="foto" class="file-label-modern">
                                        <i class="mdi mdi-cloud-upload"></i>
                                        <span>Ganti foto atau drag & drop</span>
                                        <small>Format: JPG, PNG, GIF (Max: 2MB)</small>
                                    </label>
                                </div>
                                @error('foto')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror

                                @if(!empty($pegawai->foto))
                                    <div class="current-photo">
                                        <label class="current-photo-label">
                                            <i class="mdi mdi-image"></i>
                                            Foto Saat Ini
                                        </label>
                                        <div class="photo-preview">
                                            <img src="{{ asset('storage/foto_pegawai/' . $pegawai->foto) }}" alt="Foto Pegawai">
                                            <div class="photo-info">
                                                <span>{{ $pegawai->nama_pegawai }}</span>
                                                <small>{{ $pegawai->no_pegawai }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <a href="{{ route('pegawai.index') }}" class="btn-cancel">
                            <i class="mdi mdi-close"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn-submit bg-gradient-primary">
                            <i class="mdi mdi-content-save"></i>
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
