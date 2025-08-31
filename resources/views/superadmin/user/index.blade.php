@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header -->
        <div class="header-section">
            <div class="header-top" style="display: flex; justify-content: space-between; align-items: center;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-account-key"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern">Data User</h1>
                        <p class="page-subtitle-modern">Kelola semua user sistem</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'superadmin.dashboard'], ['label' => 'User', 'route' => 'superadmin.user.index']]" />
                </div>
            </div>

            <div class="action-bar">
                <div class="search-container">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <input type="text" id="searchInput" class="search-input"
                        placeholder="Cari nama, username, atau email...">
                </div>
                <div class="action-buttons">
                    <a href="{{ route('superadmin.user.create') }}" class="btn-add-modern bg-gradient-primary">
                        <i class="mdi mdi-plus"></i> Tambah User
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Total User</h3>
                        <p class="number">{{ count($users) }}</p>
                    </div>
                    <div class="stat-icon"><i class="mdi mdi-account-key"></i></div>
                </div>
            </div>
            <div class="stat-card active">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>User Aktif</h3>
                        <p class="number">{{ $users->where('status', 'aktif')->count() }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card inactive">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>User Nonaktif</h3>
                        <p class="number">{{ $users->where('status', 'nonaktif')->count() }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-close-octagon-outline"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Daftar User</h3>
                <span class="employee-count" id="userCount">{{ count($users) }} user</span>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Blokir</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTableBody">
                        @foreach($users as $index => $user)
                            <tr class="employee-row" data-status="{{ strtolower($user->status) }}"
                                data-search="{{ strtolower($user->name . ' ' . $user->username . ' ' . $user->email) }}">
                                <td class="row-number">{{ $index + 1 }}</td>
                                <td>{{ $user->user_code }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->role?->role_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="status-badge {{ $user->status == 'aktif' ? 'status-active' : 'status-inactive' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn-block-user action-btn-table" data-userid="{{ $user->id }}">
                                        <i class="mdi {{ $user->is_blocked ? 'mdi-block-helper' : 'mdi-lock-open-outline' }}"></i>
                                    </button>
                                </td>
                                <td>
                                    <div class="action-buttons-table">
                                        <a href="{{ route('superadmin.user.edit', $user->id) }}" class="action-btn-table edit"
                                            title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('superadmin.user.destroy', $user->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf @method('DELETE')
                                            <button type="button" class="action-btn-table delete btn-delete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty state -->
            <div id="emptyState" class="empty-state" style="display:none;">
                <i class="mdi mdi-account-search"></i>
                <h3>Tidak ada data user</h3>
                <p>Tidak ada user yang sesuai dengan pencarian</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            // Search filter
            $('#searchInput').on('input', function () {
                let search = $(this).val().toLowerCase();
                let visible = 0;
                $('.employee-row').each(function () {
                    let match = $(this).data('search').includes(search);
                    $(this).toggle(match);
                    if (match) visible++;
                });
                $('#userCount').text(visible + ' user');
                $('#emptyState').toggle(visible === 0);
            });

            // Delete confirm
            $('.btn-delete').on('click', function () {
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'User akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) { form.submit(); }
                });
            });

            // Block/unblock user
            $('.btn-block-user').on('click', function () {
                let button = $(this), userId = button.data('userid');
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Ubah status blokir user ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("{{ route('superadmin.user.block') }}", {
                            _token: "{{ csrf_token() }}",
                            user_id: userId
                        }, function (data) {
                            if (data.success) {
                                // tampilkan notifikasi otomatis hilang
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true
                                });

                                let icon = button.find('i');
                                if (data.is_blocked) {
                                    icon.removeClass('mdi-lock-open-outline').addClass('mdi-block-helper');
                                    button.attr('title', 'Buka blokir');
                                } else {
                                    icon.removeClass('mdi-block-helper').addClass('mdi-lock-open-outline');
                                    button.attr('title', 'Blokir user');
                                }

                                // update badge status
                                let badge = button.closest('tr').find('.status-badge');
                                badge.removeClass('status-active status-inactive')
                                    .addClass(data.is_blocked ? 'status-inactive' : 'status-active')
                                    .text(data.is_blocked ? 'Nonaktif' : 'Aktif');

                                // update jumlah aktif/nonaktif tanpa refresh
                                let aktif = $('.status-active').length;
                                let nonaktif = $('.status-inactive').length;
                                $('.stat-card.active .number').text(aktif);
                                $('.stat-card.inactive .number').text(nonaktif);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
