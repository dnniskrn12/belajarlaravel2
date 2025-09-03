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
                        <h1 class="page-title-modern" style="margin:0;">Edit SK Magang</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Pengubahan SK Magang</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'route' => 'admin.dashboard'],
            ['label' => 'SK Magang', 'route' => 'admin.sksiswa.index'],
            ['label' => 'Edit', 'route' => 'admin.sksiswa.edit', 'params' => $sk->id],
        ]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="action-buttons">
                    <a href="{{ route('admin.sksiswa.index') }}" class="btn-filter">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- SK Lama -->
        <div class="data-card" style="margin-bottom: 32px;">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Informasi SK Magang Lama</h3>
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

                        <!-- Nomor Magang -->
                        <div class="form-group-modern">
                            <label for="no_magang" class="form-label-modern">
                                <i class="mdi mdi-identifier"></i> Nomor Magang
                            </label>
                            <input type="text" id="no_magang" class="form-input-modern readonly"
                                value="{{ $sk->no_magang }}" readonly>
                        </div>

                        <!-- Nama Magang -->
                        <div class="form-group-modern">
                            <label for="nama_siswa" class="form-label-modern">
                                <i class="mdi mdi-account"></i> Nama Siswa
                            </label>
                            <input type="text" id="nama_siswa" class="form-input-modern readonly"
                                value="{{ $sk->nama_siswa }}" readonly>
                        </div>

                        <!-- Tanggal SK Lama -->
                        <div class="form-group-modern">
                            <label for="tgl_sk" class="form-label-modern">
                                <i class="mdi mdi-calendar"></i> Tanggal SK Lama
                            </label>
                            <input type="text" id="tgl_sk" class="form-input-modern readonly"
                                value="{{ \Carbon\Carbon::parse($sk->tgl_sk)->format('d-m-Y') }}" readonly>
                        </div>

                        <!-- Unit Kerja Lama -->
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="mdi mdi-office-building"></i> Unit Kerja Lama
                            </label>
                            <input type="text" class="form-input-modern readonly"
                                value="{{ $sk->unitmagang?->nama_unitmagang }}" readonly>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- SK Baru -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Input SK Magang Baru</h3>
                <span class="form-subtitle">Isi data SK baru siswa magang</span>
            </div>

            <div class="form-container-modern">
                <form action="{{ route('admin.sksiswa.update', $sk->id) }}" method="POST">
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

                            <!-- Unit Magang Baru -->
                            <div class="form-group-modern">
                                <label for="id_unitmagang" class="form-label-modern">
                                    <i class="mdi mdi-office-building"></i> Unit Kerja Baru <span class="required">*</span>
                                </label>
                                <select name="id_unitmagang" id="id_unitmagang"
                                    class="form-input-modern @error('id_unitmagang') error @enderror" required>
                                    <option value="">-- Pilih Unit Kerja --</option>
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

                    <!-- Tombol Aksi -->
                    <div class="form-actions">
                        <a href="{{ route('admin.sksiswa.index') }}" class="btn-cancel">
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
