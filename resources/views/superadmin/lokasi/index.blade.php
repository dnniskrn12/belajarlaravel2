@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-map-marker"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Master Lokasi</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Kelola data lokasi</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'superadmin.dashboard'], ['label' => 'Master Lokasi', 'route' => 'superadmin.lokasi.index'],]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="search-container">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari nama lokasi...">
                </div>
                <div class="action-buttons">
                    <button type="button" class="btn-add-modern bg-gradient-primary" data-bs-toggle="modal"
                        data-bs-target="#addLokasiModal">
                        <i class="mdi mdi-plus"></i>
                        Tambah Lokasi
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid" style="grid-template-columns: 500px;">
            <div class="stat-card total">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Total Lokasi</h3>
                        <p class="number">{{ count($lokasi) }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-map-marker"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lokasi Table -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Daftar Lokasi</h3>
                <span class="employee-count" id="lokasiCount">{{ count($lokasi) }} lokasi</span>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>ID Lokasi</th>
                            <th>Nama Lokasi</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th style="text-align: center; width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="lokasiTableBody">
                        @forelse ($lokasi as $index => $item)
                            <tr class="lokasi-row"
                                data-search="{{ strtolower($item->id_lokasi . ' ' . $item->nama_lokasi . ' ' . $item->alamat . ' ' . $item->no_hp) }}">
                                <td class="row-number">{{ $index + 1 }}</td>
                                <td><span class="id-badge">{{ $item->id_lokasi }}</span></td>
                                <td>
                                    <div class="entity-info">
                                        <div class="entity-icon"><i class="mdi mdi-map-marker"></i></div>
                                        <div class="entity-details">
                                            <h4>{{ $item->nama_lokasi }}</h4>
                                            <p>ID {{ $item->id_lokasi }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>
                                    <div class="action-buttons-table">
                                        <button type="button" class="action-btn-table edit btn-edit-lokasi" title="Edit"
                                            data-id="{{ $item->id }}" data-id-lokasi="{{ $item->id_lokasi }}"
                                            data-nama="{{ $item->nama_lokasi }}" data-alamat="{{ $item->alamat }}"
                                            data-nohp="{{ $item->no_hp }}" data-bs-toggle="modal"
                                            data-bs-target="#editLokasiModal">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <form action="{{ route('superadmin.lokasi.destroy', $item->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-btn-table delete btn-delete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="mdi mdi-map-marker-off"></i>
                                        <h3>Tidak ada data lokasi</h3>
                                        <p>Silakan tambahkan data baru terlebih dahulu</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Lokasi Modal -->
    <div class="modal fade" id="addLokasiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header" style="background: linear-gradient(135deg, #d58df7, #a31dd8); color:white;">
                    <h5 class="modal-title"><i class="mdi mdi-plus-circle me-2"></i>Tambah Lokasi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="filter: brightness(0) invert(1);"></button>
                </div>
                <form action="{{ route('superadmin.lokasi.store') }}" method="POST" id="createLokasiForm">
                    @csrf
                    <div class="modal-body" style="padding: 32px;">

                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="id_lokasi" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-identifier me-2"></i>ID Lokasi
                            </label>
                            <input type="text" class="form-control" id="id_lokasi" name="id_lokasi"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;" required>
                            <small class="form-text text-muted">Gunakan kode unik untuk lokasi</small>
                        </div>

                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="nama_lokasi" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-map-marker me-2"></i>Nama Lokasi
                            </label>
                            <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;" required>
                            <small class="form-text text-muted">Nama lokasi lengkap</small>
                        </div>

                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="alamat" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-home-map-marker me-2"></i>Alamat
                            </label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="4"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 14px; width: 100%; min-height: 120px;"
                                required></textarea>
                            <small class="form-text text-muted">Masukkan alamat lengkap lokasi</small>
                        </div>

                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="no_hp" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-phone me-2"></i>No. HP
                            </label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;" required>
                            <small class="form-text text-muted">Nomor HP yang bisa dihubungi</small>
                        </div>

                    </div>
                    <div class="modal-footer" style="border: none; padding: 24px 32px;">
                        <button type="reset" class="btn btn-secondary" style="border-radius: 8px; padding: 10px 20px;">
                            <i class="mdi mdi-refresh me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-success"
                            style="background: linear-gradient(135deg, #d58df7, #a31dd8); border: none; border-radius: 8px; padding: 10px 20px;">
                            <i class="mdi mdi-plus me-2"></i>Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Edit Lokasi Modal -->
    <div class="modal fade" id="editLokasiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header" style="background: linear-gradient(135deg, #f59e0b, #d97706); color:white;">
                    <h5 class="modal-title"><i class="mdi mdi-pencil-circle me-2"></i>Edit Lokasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="filter: brightness(0) invert(1);"></button>
                </div>
                <form action="" method="POST" id="editLokasiForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" style="padding: 32px;">

                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="edit_id_lokasi" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-identifier me-2"></i>ID Lokasi
                            </label>
                            <input type="text" class="form-control" id="edit_id_lokasi" name="id_lokasi"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;" required>
                        </div>

                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="edit_nama_lokasi" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-map-marker me-2"></i>Nama Lokasi
                            </label>
                            <input type="text" class="form-control" id="edit_nama_lokasi" name="nama_lokasi"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;" required>
                        </div>

                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="edit_alamat" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-home-map-marker me-2"></i>Alamat
                            </label>
                            <textarea class="form-control" id="edit_alamat" name="alamat" rows="4"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 14px; width: 100%; min-height: 120px;"
                                required></textarea>
                        </div>

                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="edit_no_hp" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-phone me-2"></i>No. HP
                            </label>
                            <input type="text" class="form-control" id="edit_no_hp" name="no_hp"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;" required>
                        </div>

                    </div>
                    <div class="modal-footer" style="border: none; padding: 24px 32px;">
                        <button type="reset" class="btn btn-secondary" style="border-radius: 8px; padding: 10px 20px;">
                            <i class="mdi mdi-refresh me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-warning"
                            style="background: linear-gradient(135deg, #f59e0b, #d97706); border: none; border-radius: 8px; padding: 10px 20px; color: white;">
                            <i class="mdi mdi-check me-2"></i>Update
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function () {
            // Search
            $('#searchInput').on('input', function () {
                const search = $(this).val().toLowerCase();
                let visible = 0;
                $('.lokasi-row').each(function () {
                    const match = $(this).data('search').includes(search);
                    if (match) {
                        $(this).show();
                        visible++;
                        $(this).find('.row-number').text(visible);
                    } else {
                        $(this).hide();
                    }
                });
                $('#lokasiCount').text(visible + ' lokasi');
            });

            // Edit
            $('.btn-edit-lokasi').on('click', function () {
                $('#edit_id_lokasi').val($(this).data('id-lokasi'));
                $('#edit_nama_lokasi').val($(this).data('nama'));
                $('#edit_alamat').val($(this).data('alamat'));
                $('#edit_no_hp').val($(this).data('nohp'));
                $('#editLokasiForm').attr('action', '/superadmin/lokasi/' + $(this).data('id'));
            });

            // Delete
            $('.btn-delete').on('click', function () {
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus Lokasi?',
                    text: "Data tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });

            // Flash
            @if(session('success'))
                Swal.fire('Berhasil', '{{ session("success") }}', 'success');
            @endif
            @if(session('error'))
                Swal.fire('Error', '{{ session("error") }}', 'error');
            @endif
                });
    </script>
@endsection
