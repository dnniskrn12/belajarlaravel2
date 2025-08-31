@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top d-flex justify-content-between align-items-center">
                <div class="header-title d-flex align-items-center gap-2">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-account-edit"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern mb-0">Edit Magang</h1>
                        <p class="page-subtitle-modern mb-0">Ubah data magang {{ $magang->nama_magang }}</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'route' => 'home'],
            ['label' => 'Magang', 'route' => 'admin.magang.index'],
            ['label' => 'Edit', 'route' => 'admin.magang.edit'],
        ]" />
                </div>
            </div>
            <div class="action-bar">
                <a href="{{ route('admin.magang.index') }}" class="btn-filter">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Form Edit Magang</h3>
                <span class="form-subtitle">Perbarui informasi magang</span>
            </div>

            <div class="form-container-modern">
                <form action="{{ route('admin.magang.update', $magang->id) }}" method="POST" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Personal Information -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-account"></i>
                            <h4>Informasi Personal</h4>
                        </div>
                        <div class="purple-card">
                            <div class="form-grid">
                                <div class="form-group-modern">
                                    <label for="no_magang" class="form-label-modern">
                                        <i class="mdi mdi-identifier"></i> Nomor Magang
                                        <span class="readonly-badge">Read-only</span>
                                    </label>
                                    <input type="text" name="no_magang" id="no_magang"
                                        class="form-input-modern readonly @error('no_magang') error @enderror"
                                        value="{{ $magang->no_magang }}" readonly>
                                    @error('no_magang')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="nama_magang" class="form-label-modern">
                                        <i class="mdi mdi-account-outline"></i> Nama Lengkap
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="nama_magang" id="nama_magang"
                                        class="form-input-modern @error('nama_magang') error @enderror"
                                        value="{{ old('nama_magang', $magang->nama_magang) }}"
                                        placeholder="Masukkan nama lengkap" required>
                                    @error('nama_magang')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="tempat_lahir" class="form-label-modern">
                                        <i class="mdi mdi-map-marker"></i> Tempat Lahir
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir"
                                        class="form-input-modern @error('tempat_lahir') error @enderror"
                                        value="{{ old('tempat_lahir', $magang->tempat_lahir) }}"
                                        placeholder="Masukkan tempat lahir" required>
                                    @error('tempat_lahir')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="tgl_lahir" class="form-label-modern">
                                        <i class="mdi mdi-calendar"></i> Tanggal Lahir
                                        <span class="required">*</span>
                                    </label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir"
                                        class="form-input-modern @error('tgl_lahir') error @enderror"
                                        value="{{ old('tgl_lahir', $magang->tgl_lahir) }}" required>
                                    @error('tgl_lahir')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="jenis_kelamin" class="form-label-modern">
                                        <i class="mdi mdi-gender-male-female"></i> Jenis Kelamin
                                        <span class="required">*</span>
                                    </label>
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-select-modern @error('jenis_kelamin') error @enderror" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin', $magang->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin', $magang->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
    <select name="agama" id="agama"
        class="form-input-modern @error('agama') error @enderror" required>
        <option value="">-- Pilih Agama --</option>
        <option value="Islam" @selected(old('agama', $magang->agama ?? '') == 'Islam')>Islam</option>
        <option value="Kristen Protestan" @selected(old('agama', $magang->agama ?? '') == 'Kristen Protestan')>Kristen Protestan</option>
        <option value="Katholik" @selected(old('agama', $magang->agama ?? '') == 'Katholik')>Katholik</option>
        <option value="Hindu" @selected(old('agama', $magang->agama ?? '') == 'Hindu')>Hindu</option>
        <option value="Budha" @selected(old('agama', $magang->agama ?? '') == 'Budha')>Budha</option>
        <option value="Konghucu" @selected(old('agama', $magang->agama ?? '') == 'Konghucu')>Konghucu</option>
    </select>
    @error('agama')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>



                            </div>

                            <div class="form-group-modern full-width">
                                <label for="alamat" class="form-label-modern">
                                    <i class="mdi mdi-home"></i> Alamat
                                    <span class="required">*</span>
                                </label>
                                <textarea name="alamat" id="alamat"
                                    class="form-textarea-modern @error('alamat') error @enderror" rows="3"
                                    required>{{ old('alamat', $magang->alamat) }}</textarea>
                                @error('alamat')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-phone"></i>
                            <h4>Informasi Kontak</h4>
                        </div>
                        <div class="purple-card">
                            <div class="form-grid">
                                <div class="form-group-modern">
                                    <label for="no_hp" class="form-label-modern">
                                        <i class="mdi mdi-cellphone"></i> No HP
                                    </label>
                                    <input type="text" name="no_hp" id="no_hp"
                                        class="form-input-modern @error('no_hp') error @enderror"
                                        value="{{ old('no_hp', $magang->no_hp) }}">
                                    @error('no_hp')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label for="email" class="form-label-modern">
                                        <i class="mdi mdi-email"></i> Email
                                    </label>
                                    <input type="email" name="email" id="email"
                                        class="form-input-modern @error('email') error @enderror"
                                        value="{{ old('email', $magang->email) }}">
                                    @error('email')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pendidikan -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-school"></i>
                            <h4>Informasi Pendidikan</h4>
                        </div>
                        <div id="pendidikan-wrapper" class="education-wrapper">
                            @foreach($magang->pend_magang as $i => $pend)
                                <div class="education-item">
                                    <div class="purple-card">
                                        <div class="education-card-header">
                                            <div class="education-number">
                                                <i class="mdi mdi-numeric-{{ $i + 1 }}-circle"></i>
                                                <span>Pendidikan {{ $i + 1 }}</span>
                                            </div>
                                            <button type="button" class="btn-remove-education" data-tooltip="Hapus Pendidikan">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        </div>

                                        <div class="form-grid">
                                            <div class="form-group-modern">
                                                <label class="form-label-modern">Jenjang Pendidikan <span
                                                        class="required">*</span></label>
                                                <select name="pendidikan[{{ $i }}][id_jjg]" class="form-select-modern" required>
                                                    <option value="">-- Pilih Jenjang Pendidikan --</option>
                                                    @foreach($jenjang as $jjg)
                                                        <option value="{{ $jjg->id_jjg }}" {{ $pend->id_jjg == $jjg->id_jjg ? 'selected' : '' }}>{{ $jjg->nama_jenjang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group-modern">
                                                <label class="form-label-modern">Nama Pendidikan</label>
                                                <input type="text" name="pendidikan[{{ $i }}][nama_pend]"
                                                    class="form-input-modern" value="{{ $pend->nama_pend }}">
                                            </div>

                                            <div class="form-group-modern">
                                                <label class="form-label-modern">Tahun Pendidikan</label>
                                                <input type="number" name="pendidikan[{{ $i }}][thn_pend]"
                                                    class="form-input-modern" value="{{ $pend->thn_pend }}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="add-education-container">
                                <button type="button" class="btn-add-education" id="add-pendidikan">
                                    <i class="mdi mdi-plus-circle"></i>
                                    <span>Tambah Pendidikan</span>
                                </button>
                                <p class="add-education-hint">Tambahkan riwayat pendidikan dari yang terbaru</p>
                            </div>
                            <div id="jenjang-options" style="display:none;">
                                @foreach($jenjang as $jjg)

                                    <option value="">-- Pilih Jenjang Pendidikan --</option>
                                    <option value="{{ $jjg->id_jjg }}">{{ $jjg->nama_jenjang }}</option>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Employment Information Section -->
                    <!-- Informasi Pekerjaan -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <i class="mdi mdi-briefcase"></i>
                            <h4>Informasi Pekerjaan</h4>
                        </div>
                        <div class="purple-card">
                            <div class="form-grid">


                                <!-- Status Pekerjaan -->
                                <div class="form-group-modern">
                                    <label for="status_magang" class="form-label-modern">
                                        <i class="mdi mdi-account-check"></i> Status Pekerjaan <span
                                            class="required">*</span>
                                    </label>
                                    <select name="status_magang" id="status_magang"
                                        class="form-select-modern @error('status_magang') error @enderror" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Aktif" {{ old('status_magang', $magang->status_magang) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Non Aktif" {{ old('status_magang', $magang->status_magang) == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                                    </select>
                                    @error('status_magang') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Tanggal Masuk -->
                                <div class="form-group-modern">
                                    <label for="tgl_masuk" class="form-label-modern">
                                        <i class="mdi mdi-calendar-check"></i> Tanggal Masuk <span class="required">*</span>
                                    </label>
                                    <input type="date" name="tgl_masuk" id="tgl_masuk"
                                        class="form-input-modern @error('tgl_masuk') error @enderror"
                                        value="{{ old('tgl_masuk', $magang->tgl_masuk) }}" required>
                                    @error('tgl_masuk') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Tanggal Akhir -->
                                <div class="form-group-modern">
                                    <label for="tgl_akhir" class="form-label-modern">
                                        <i class="mdi mdi-calendar-remove"></i> Tanggal Akhir
                                    </label>
                                    <input type="date" name="tgl_akhir" id="tgl_akhir"
                                        class="form-input-modern @error('tgl_akhir') error @enderror"
                                        value="{{ old('tgl_akhir', $magang->tgl_akhir) }}">
                                    @error('tgl_akhir') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Foto -->
                                <div class="form-group-modern">
                                    <label for="foto" class="form-label-modern">
                                        <i class="mdi mdi-camera"></i> Foto Magang <span class="required">*</span>
                                    </label>
                                    <div class="foto-preview mb-2 text-center">
                                        <img id="preview-foto" src="{{ $magang->foto ? asset('storage/foto_magang/' . $magang->foto)
        : asset('template/dist/assets/images/default.png') }}" alt="Preview Foto"
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
                                    @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.magang.index') }}" class="btn-cancel">
                            <i class="mdi mdi-close"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn-submit bg-gradient-primary">
                            <i class="mdi mdi-content-save"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
