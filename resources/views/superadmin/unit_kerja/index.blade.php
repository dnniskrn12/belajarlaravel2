@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-domain"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Master Unit Kerja</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Kelola data unit kerja</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'superadmin.dashboard'], ['label' => 'Master Unit Kerja', 'route' => 'superadmin.unitkerja.index'],]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="search-container">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari nama unit kerja...">
                </div>
                <div class="action-buttons">
                    <button type="button" class="btn-add-modern bg-gradient-primary" data-bs-toggle="modal"
                        data-bs-target="#addUnitKerjaModal">
                        <i class="mdi mdi-plus"></i>
                        Tambah Unit Kerja
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid" style="grid-template-columns: 500px;">
            <div class="stat-card total">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Total Unit Kerja</h3>
                        <p class="number">{{ count($unitkerja) }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-domain"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit Kerja Table -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Daftar Unit Kerja</h3>
                <span class="employee-count" id="unitKerjaCount">{{ count($unitkerja) }} unit kerja</span>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th style="width: 80px;">No</th>
                            <th>ID Unit Kerja</th>
                            <th>Nama Unit Kerja</th>
                            <th style="text-align: center; width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="unitKerjaTableBody">
                        @forelse ($unitkerja as $index => $item)
                            <tr class="unitkerja-row"
                                data-search="{{ strtolower($item->id_unitkerja . ' ' . $item->nama_unitkerja) }}">
                                <td class="row-number">{{ $index + 1 }}</td>
                                <td>
                                    <div class="id-info">
                                        <span class="id-badge">{{ $item->id_unitkerja }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="entity-info">
                                        <div class="entity-icon">
                                            <i class="mdi mdi-domain"></i>
                                        </div>
                                        <div class="entity-details">
                                            <h4>{{ $item->nama_unitkerja }}</h4>
                                            <p>Unit Kerja {{ $item->id_unitkerja }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons-table">
                                        <button type="button" class="action-btn-table edit btn-edit-unitkerja" title="Edit"
                                            data-id="{{ $item->id }}" data-id-unitkerja="{{ $item->id_unitkerja }}"
                                            data-nama="{{ $item->nama_unitkerja }}" data-bs-toggle="modal"
                                            data-bs-target="#editUnitKerjaModal">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <form action="{{ route('superadmin.unitkerja.destroy', $item->id) }}" method="POST"
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
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="mdi mdi-account-search"></i>
                                        <h3>Tidak ada data unit kerja</h3>
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

    <!-- Add Unit Kerja Modal -->
    <div class="modal fade" id="addUnitKerjaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #d58df7, #a31dd8); color: white; border: none;">
                    <h5 class="modal-title" style="font-weight: 600;">
                        <i class="mdi mdi-plus-circle me-2"></i>Tambah Unit Kerja Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="filter: brightness(0) invert(1);"></button>
                </div>
                <form action="{{ route('superadmin.unitkerja.store') }}" method="POST" id="addUnitKerjaForm">
                    @csrf
                    <div class="modal-body" style="padding: 32px;">
                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="id_unitkerja" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-identifier me-2"></i>ID Unit Kerja
                            </label>
                            <input type="text" class="form-control" id="id_unitkerja" name="id_unitkerja"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;"
                                placeholder="Masukkan ID unit kerja (contoh: UKJ001)" required>
                            <small class="form-text text-muted">Gunakan kode unik untuk unit kerja</small>
                        </div>

                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="nama_unitkerja" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-office-building me-2"></i>Nama Unit Kerja
                            </label>
                            <input type="text" class="form-control" id="nama_unitkerja" name="nama_unitkerja"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;"
                                placeholder="Masukkan nama unit kerja" required>
                            <small class="form-text text-muted">Nama lengkap unit kerja</small>
                        </div>
                    </div>
                    <div class="modal-footer" style="border: none; padding: 24px 32px;">
                        <button type="reset" class="btn btn-secondary" style="border-radius: 8px; padding: 10px 20px;">
                            <i class="mdi mdi-refresh me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-primary"
                            style="background: linear-gradient(135deg, #d58df7, #a31dd8); border: none; border-radius: 8px; padding: 10px 20px;">
                            <i class="mdi mdi-check me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Unit Kerja Modal -->
    <div class="modal fade" id="editUnitKerjaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none;">
                    <h5 class="modal-title" style="font-weight: 600;">
                        <i class="mdi mdi-pencil-circle me-2"></i>Edit Unit Kerja
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="filter: brightness(0) invert(1);"></button>
                </div>
                <form action="" method="POST" id="editUnitKerjaForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" style="padding: 32px;">
                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="edit_id_unitkerja" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-identifier me-2"></i>ID Unit Kerja
                            </label>
                            <input type="text" class="form-control" id="edit_id_unitkerja" name="id_unitkerja"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;" required>
                            <small class="form-text text-muted">Gunakan kode unik untuk unit kerja</small>
                        </div>

                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="edit_nama_unitkerja" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-office-building me-2"></i>Nama Unit Kerja
                            </label>
                            <input type="text" class="form-control" id="edit_nama_unitkerja" name="nama_unitkerja"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;" required>
                            <small class="form-text text-muted">Nama lengkap unit kerja</small>
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

    {{-- JS & CSS Umum --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            // Search functionality
            $('#searchInput').on('input', function () {
                const searchTerm = $(this).val().toLowerCase();
                let visibleCount = 0;

                $('.unitkerja-row').each(function () {
                    const $row = $(this);
                    const searchData = $row.data('search');
                    const matches = !searchTerm || searchData.includes(searchTerm);

                    if (matches) {
                        $row.show();
                        visibleCount++;
                        $row.find('.row-number').text(visibleCount);
                    } else {
                        $row.hide();
                    }
                });

                $('#unitKerjaCount').text(visibleCount + ' unit kerja');
                $('#emptyState').toggle(visibleCount === 0);
            });

            // Edit unit kerja modal
            $('.btn-edit-unitkerja').on('click', function () {
                const id = $(this).data('id');
                const idUnitKerja = $(this).data('id-unitkerja');
                const nama = $(this).data('nama');

                $('#edit_id_unitkerja').val(idUnitKerja);
                $('#edit_nama_unitkerja').val(nama);
                $('#editUnitKerjaForm').attr('action', `/superadmin/unitkerja/${id}`);
            });

            // Delete confirmation
            $('.btn-delete').on('click', function () {
                const form = $(this).closest('form');

                Swal.fire({
                    title: 'Konfirmasi Penghapusan',
                    html: 'Yakin ingin menghapus data unit kerja ini?<br><b>Data tidak bisa dikembalikan!</b>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });

            // Form validation add
            $('#addUnitKerjaForm').on('submit', function (e) {
                const idUnitKerja = $('#id_unitkerja').val().trim();
                const namaUnitKerja = $('#nama_unitkerja').val().trim();

                if (!idUnitKerja || !namaUnitKerja) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Data Tidak Lengkap',
                        text: 'Harap isi semua field yang diperlukan!',
                        icon: 'warning',
                        confirmButtonColor: '#d58df7'
                    });
                }
            });

            // Form validation edit
            $('#editUnitKerjaForm').on('submit', function (e) {
                const idUnitKerja = $('#edit_id_unitkerja').val().trim();
                const namaUnitKerja = $('#edit_nama_unitkerja').val().trim();

                if (!idUnitKerja || !namaUnitKerja) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Data Tidak Lengkap',
                        text: 'Harap isi semua field yang diperlukan!',
                        icon: 'warning',
                        confirmButtonColor: '#f59e0b'
                    });
                }
            });

            // Reset form when modal is closed
            $('#addUnitKerjaModal').on('hidden.bs.modal', function () {
                $('#addUnitKerjaForm')[0].reset();
            });

            // Flash message
            @if(session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session("success") }}',
                    icon: 'success',
                    confirmButtonColor: '#d58df7'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session("error") }}',
                    icon: 'error',
                    confirmButtonColor: '#dc2626'
                });
            @endif
        });
    </script>
@endsection
