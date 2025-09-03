@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-file-document-edit"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Edit SK Kerja</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Pengubahan (Kenaikan atau Penurunan) SK kerja
                            pegawai</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'route' => 'home'],
            ['label' => 'SK Kerja', 'route' => 'admin.skkerja.index'],
            ['label' => 'Edit', 'route' => 'admin.skkerja.edit', 'params' => $sk->id],
        ]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="action-buttons">
                    <a href="{{ route('admin.skkerja.index') }}" class="btn-filter">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- SK Lama -->
        <div class="data-card" style="margin-bottom: 32px;">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Informasi SK Kerja Lama</h3>
                <span class="form-subtitle">Data ini hanya untuk dibaca (readonly)</span>
            </div>
            <div class="form-container-modern">
                <div class="purple-card">
                    <div class="form-grid">
                        <!-- Nomor SK Lama -->
                        <div class="form-group-modern">
                            <label for="no_sk" class="form-label-modern">
                                <i class="mdi mdi-numeric"></i> Nomor SK Lama
                            </label>
                            <input type="text" id="no_sk" class="form-input-modern readonly" value="{{ $sk->no_sk }}"
                                readonly>
                        </div>

                        <!-- Nomor Pegawai -->
                        <div class="form-group-modern">
                            <label for="no_pegawai" class="form-label-modern">
                                <i class="mdi mdi-identifier"></i> Nomor Pegawai
                            </label>
                            <input type="text" id="no_pegawai" class="form-input-modern readonly"
                                value="{{ $sk->no_pegawai }} - {{$sk->nama_pegawai}}" readonly>
                        </div>

                        <!-- Nama Pegawai -->
                        <div class="form-group-modern">
                            <label for="nama_pegawai" class="form-label-modern">
                                <i class="mdi mdi-account"></i> Nama Pegawai
                            </label>
                            <input type="text" id="nama_pegawai" class="form-input-modern readonly"
                                value="{{ $sk->nama_pegawai }}" readonly>
                        </div>

                        <!-- Tanggal SK Lama -->
                        <div class="form-group-modern">
                            <label for="tgl_sk" class="form-label-modern">
                                <i class="mdi mdi-calendar"></i> Tanggal SK Lama
                            </label>
                            <input type="text" id="tgl_sk" class="form-input-modern readonly"
                                value="{{ \Carbon\Carbon::parse($sk->tgl_sk)->format('d-m-Y') }}" readonly>
                        </div>

                        <!-- Jabatan Lama -->
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="mdi mdi-briefcase"></i> Jabatan Lama
                            </label>
                            <input type="text" class="form-input-modern readonly" value="{{ $sk->jabatan?->nama_jabatan }}"
                                readonly>
                        </div>

                        <!-- Unit Kerja Lama -->
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="mdi mdi-office-building"></i> Unit Kerja Lama
                            </label>
                            <input type="text" class="form-input-modern readonly"
                                value="{{ $sk->unitkerja?->nama_unitkerja }}" readonly>
                        </div>

                        <!-- Lokasi Lama -->
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="mdi mdi-map-marker"></i> Lokasi Lama
                            </label>
                            <input type="text" class="form-input-modern readonly" value="{{ $sk->lokasi?->nama_lokasi }}"
                                readonly>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- SK Baru -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Input SK Kerja Baru</h3>
                <span class="form-subtitle">Isi data SK baru pegawai</span>
            </div>

            <div class="form-container-modern">
                <form action="{{ route('admin.skkerja.update', $sk->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="purple-card">
                        <div class="form-grid">
                            <!-- Nomor SK Baru -->
                            <div class="form-group-modern">
                                <label for="no_sk" class="form-label-modern">
                                    <i class="mdi mdi-numeric"></i> Nomor SK Baru <span class="required">*</span>
                                </label>
                                <input type="text" name="no_sk" id="no_sk"
                                    class="form-input-modern @error('no_sk') error @enderror" value="{{ old('no_sk') }}"
                                    placeholder="Masukkan nomor SK baru" required>
                                @error('no_sk') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>


                            <!-- Tanggal SK Baru -->
                            <div class="form-group-modern">
                                <label for="tgl_sk" class="form-label-modern">
                                    <i class="mdi mdi-calendar"></i> Tanggal SK Baru <span class="required">*</span>
                                </label>
                                <input type="date" name="tgl_sk" id="tgl_sk"
                                    class="form-input-modern @error('tgl_sk') error @enderror" value="{{ old('tgl_sk') }}"
                                    required>
                                @error('tgl_sk') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Jabatan Baru -->
                            <div class="form-group-modern">
                                <label for="id_jabatan" class="form-label-modern">
                                    <i class="mdi mdi-briefcase"></i> Jabatan Baru <span class="required">*</span>
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

                            <!-- Unit Kerja Baru -->
                            <div class="form-group-modern">
                                <label for="id_unitkerja" class="form-label-modern">
                                    <i class="mdi mdi-office-building"></i> Unit Kerja Baru <span class="required">*</span>
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

                            <!-- Lokasi Baru -->
                            <div class="form-group-modern">
                                <label for="id_lokasi" class="form-label-modern">
                                    <i class="mdi mdi-map-marker"></i> Lokasi Baru <span class="required">*</span>
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

                    <!-- Tombol Aksi -->
                    <div class="form-actions">
                        <a href="{{ route('admin.skkerja.index') }}" class="btn-cancel">
                            <i class="mdi mdi-close"></i> Batal
                        </a>
                        <button type="submit" class="btn-submit bg-gradient-primary">
                            <i class="mdi mdi-content-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
