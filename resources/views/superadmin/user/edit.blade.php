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
                    <h1 class="page-title-modern" style="margin:0;">Edit User</h1>
                    <p class="page-subtitle-modern" style="margin:0;">Perbarui data user</p>
                </div>
            </div>
            <div class="header-breadcrumbs">
                <x-breadcrumbs :items="[
                    ['label' => 'Dashboard', 'route' => 'superadmin.dashboard'],
                    ['label' => 'User', 'route' => 'superadmin.user.index'],
                    ['label' => 'Edit', 'route' => 'superadmin.user.edit', 'params' => $user->id],
                ]" />
            </div>
        </div>
        <div class="action-bar">
            <div class="action-buttons">
                <a href="{{ route('superadmin.user.index') }}" class="btn-filter">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="data-card">
        <div class="card-header-clean">
            <h3 class="card-title-clean">Form Data User</h3>
            <span class="form-subtitle">Lengkapi semua informasi user</span>
        </div>

        <div class="form-container-modern">
            <form action="{{ route('superadmin.user.update', $user->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                <!-- Informasi Akun -->
                <div class="form-section">
                    <div class="form-section-header">
                        <i class="mdi mdi-account"></i>
                        <h4>Informasi Akun</h4>
                    </div>
                    <div class="purple-card">
                        <div class="form-grid">

                            <div class="form-group-modern">
                                <label for="name" class="form-label-modern">
                                    <i class="mdi mdi-account-outline"></i>
                                    Nama Lengkap<span class="required">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                    class="form-input-modern @error('name') error @enderror"
                                    value="{{ old('name') ?? $user->name }}" placeholder="Masukkan nama lengkap" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group-modern">
                                <label for="username" class="form-label-modern">
                                    <i class="mdi mdi-identifier"></i>
                                    Username <span class="required">*</span>
                                </label>
                                <input type="text" name="username" id="username"
                                    class="form-input-modern @error('username') error @enderror"
                                    value="{{ old('username') ?? $user->username }}" placeholder="Masukkan username unik" required>
                                @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group-modern">
                                <label for="email" class="form-label-modern">
                                    <i class="mdi mdi-email"></i>
                                    Email <span class="required">*</span>
                                </label>
                                <input type="email" name="email" id="email"
                                    class="form-input-modern @error('email') error @enderror"
                                    value="{{ old('email') ?? $user->email }}" placeholder="Masukkan email valid" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group-modern">
                                <label for="role_id" class="form-label-modern">
                                    <i class="mdi mdi-account-key"></i>
                                    Role <span class="required">*</span>
                                </label>
                                <select name="role_id" id="role_id"
                                    class="form-input-modern @error('role_id') error @enderror" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="1" {{ (old('role_id') ?? $user->role_id) == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ (old('role_id') ?? $user->role_id) == 2 ? 'selected' : '' }}>Superadmin</option>
                                    <option value="3" {{ (old('role_id') ?? $user->role_id) == 3 ? 'selected' : '' }}>Pimpinan</option>
                                </select>
                                @error('role_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group-modern" style="position:relative;">
                                <label for="password" class="form-label-modern">
                                    <i class="mdi mdi-lock"></i>
                                    Password
                                </label>
                                <input type="password" name="password" id="password"
                                    class="form-input-modern @error('password') error @enderror"
                                    placeholder="Kosongkan jika tidak ingin mengubah password">
                                <i id="togglePassword" class="mdi mdi-eye-outline"
                                   style="position:absolute; right:10px; top:38px; cursor:pointer;"></i>
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group-modern" style="position:relative;">
                                <label for="password_confirmation" class="form-label-modern">
                                    <i class="mdi mdi-lock-check"></i>
                                    Konfirmasi Password
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-input-modern @error('password_confirmation') error @enderror"
                                    placeholder="Ketik ulang password jika diubah">
                                <i id="toggleConfirmPassword" class="mdi mdi-eye-outline"
                                   style="position:absolute; right:10px; top:38px; cursor:pointer;"></i>
                                @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="form-actions">
                    <a href="{{ route('superadmin.user.index') }}" class="btn-cancel">
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

@push('script')
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('mdi-eye-outline');
        this.classList.toggle('mdi-eye-off-outline');
    });

    const toggleConfirm = document.querySelector('#toggleConfirmPassword');
    const confirmPassword = document.querySelector('#password_confirmation');
    toggleConfirm.addEventListener('click', function () {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('mdi-eye-outline');
        this.classList.toggle('mdi-eye-off-outline');
    });
</script>
@endpush
