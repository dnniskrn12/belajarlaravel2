@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <div class="header-section mb-4">
            <div class="header-top d-flex justify-content-between align-items-center">
                <div class="header-title d-flex align-items-center gap-2">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-account-circle"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern mb-0">Profil Saya</h1>
                        <p class="page-subtitle-modern mb-0">Kelola informasi akun</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- Kartu profil --}}
            <div class="col-md-4">
                <div class="card shadow-sm text-center p-4 h-100">
                    <div class="mb-3">
                        <div class="avatar-circle bg-gradient-primary mx-auto">
                            <i class="mdi mdi-account text-white" style="font-size:48px;"></i>
                        </div>
                    </div>
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-1">{{ '@' . $user->username }}</p>
                    <div class="mt-3">

                        <small class="text-muted">Status :
                            <span class="badge bg-success">Aktif</span>
                        </small>

                    </div>
                </div>
            </div>

            {{-- Form edit --}}
            <div class="col-md-8">
                <div class="data-card h-100">
                    <div class="card-header-clean">
                        <h3 class="card-title-clean">Edit Profil</h3>
                        <span class="form-subtitle">Ubah nama, username, email, atau password</span>
                    </div>

                    <div class="form-container-modern py-4"><!-- Tambah padding atas & bawah -->
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" novalidate>
                            @csrf

                            <div class="form-grid mb-4"><!-- Jarak bawah -->
                                <div class="form-group-modern">
                                    <label class="form-label-modern"><i class="mdi mdi-account-outline"></i> Nama</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="form-input-modern @error('name') error @enderror" required>
                                    @error('name') <span class="form-error">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern"><i class="mdi mdi-at"></i> Username</label>
                                    <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                        class="form-input-modern @error('username') error @enderror" required>
                                    @error('username') <span class="form-error">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group-modern">
                                    <label class="form-label-modern"><i class="mdi mdi-email-outline"></i> Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="form-input-modern @error('email') error @enderror" required>
                                    @error('email') <span class="form-error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-grid mb-4">
                                <div class="form-group-modern position-relative">
                                    <label class="form-label-modern"><i class="mdi mdi-lock-outline"></i> Password Baru
                                        (opsional)</label>
                                    <input type="password" name="password" id="password"
                                        class="form-input-modern @error('password') error @enderror"
                                        placeholder="Kosongkan jika tidak mengganti">
                                    <i class="mdi mdi-eye-off toggle-password" data-target="password"></i>
                                    @error('password') <span class="form-error">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group-modern position-relative">
                                    <label class="form-label-modern"><i class="mdi mdi-lock-check-outline"></i> Konfirmasi
                                        Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-input-modern">
                                    <i class="mdi mdi-eye-off toggle-password" data-target="password_confirmation"></i>
                                </div>
                            </div>

                            <div class="form-actions mt-3">
                                <button type="submit" class="btn-submit bg-gradient-primary">
                                    <i class="mdi mdi-content-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-circle {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-group-modern {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 38px;
            right: 12px;
            cursor: pointer;
            font-size: 18px;
            color: #888;
        }

        .toggle-password.active {
            color: #6f42c1;
            /* ungu */
        }
    </style>

    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', () => {
                const targetId = icon.getAttribute('data-target');
                const input = document.getElementById(targetId);
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("mdi-eye-off");
                    icon.classList.add("mdi-eye");
                    icon.classList.add("active");
                } else {
                    input.type = "password";
                    icon.classList.remove("mdi-eye");
                    icon.classList.add("mdi-eye-off");
                    icon.classList.remove("active");
                }
            });
        });
    </script>
@endsection
