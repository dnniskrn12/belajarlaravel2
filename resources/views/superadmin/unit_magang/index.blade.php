@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-school"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Master Unit Magang</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Kelola data unit magang</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'superadmin.dashboard'], ['label' => 'Master Unit Magang', 'route' => 'superadmin.unitmagang.index'],]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="search-container">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari nama unit magang...">
                </div>
                <div class="action-buttons">
                    <button type="button" class="btn-add-modern bg-gradient-primary" data-bs-toggle="modal"
                        data-bs-target="#addUnitMagangModal">
                        <i class="mdi mdi-plus"></i>
                        Tambah Unit Magang
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid" style="grid-template-columns: 500px;">
            <div class="stat-card total">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Total Unit Magang</h3>
                        <p class="number">{{ count($unitmagang) }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-school"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit Magang Table -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Daftar Unit Magang</h3>
                <span class="employee-count" id="unitMagangCount">{{ count($unitmagang) }} unit magang</span>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th style="width: 80px;">No</th>
                            <th>ID Unit Magang</th>
                            <th>Nama Unit Magang</th>
                            <th style="text-align: center; width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="unitMagangTableBody">
                        @forelse ($unitmagang as $index => $item)
                            <tr class="unitmagang-row"
                                data-search="{{ strtolower($item->id_unitmagang . ' ' . $item->nama_unitmagang) }}">
                                <td class="row-number">{{ $index + 1 }}</td>
                                <td>
                                    <div class="id-info">
                                        <span class="id-badge">{{ $item->id_unitmagang }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="entity-info">
                                        <div class="entity-icon">
                                            <i class="mdi mdi-school"></i>
                                        </div>
                                        <div class="entity-details">
                                            <h4>{{ $item->nama_unitmagang }}</h4>
                                            <p>Unit Magang {{ $item->id_unitmagang }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons-table">
                                        <button type="button" class="action-btn-table edit btn-edit-unitmagang" title="Edit"
                                            data-id="{{ $item->id }}" data-id-unitmagang="{{ $item->id_unitmagang }}"
                                            data-nama="{{ $item->nama_unitmagang }}" data-bs-toggle="modal"
                                            data-bs-target="#editUnitMagangModal">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <form action="{{ route('superadmin.unitmagang.destroy', $item->id) }}" method="POST"
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
                                        <h3>Tidak ada data unit magang</h3>
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

    <!-- Add Unit Magang Modal -->
    <div class="modal fade" id="addUnitMagangModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #d58df7, #a31dd8); color: white; border: none;">
                    <h5 class="modal-title" style="font-weight: 600;">
                        <i class="mdi mdi-plus-circle me-2"></i>Tambah Unit Magang Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="filter: brightness(0) invert(1);"></button>
                </div>
                <form action="{{ route('superadmin.unitmagang.store') }}" method="POST" id="addUnitMagangForm">
                    @csrf
                    <div class="modal-body" style="padding: 32px;">
                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="id_unitmagang" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-identifier me-2"></i>ID Unit Magang
                            </label>
                            <input type="text" class="form-control" id="id_unitmagang" name="id_unitmagang"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;"
                                placeholder="Masukkan ID unit magang (contoh: MAG001)" required>
                            <small class="form-text text-muted">Gunakan kode unik untuk unit magang</small>
                        </div>

                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="nama_unitmagang" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-school me-2"></i>Nama Unit Magang
                            </label>
                            <input type="text" class="form-control" id="nama_unitmagang" name="nama_unitmagang"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;"
                                placeholder="Masukkan nama unit magang" required>
                            <small class="form-text text-muted">Nama lengkap unit magang</small>
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

    <!-- Edit Unit Magang Modal -->
    <div class="modal fade" id="editUnitMagangModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none;">
                    <h5 class="modal-title" style="font-weight: 600;">
                        <i class="mdi mdi-pencil-circle me-2"></i>Edit Unit Magang
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="filter: brightness(0) invert(1);"></button>
                </div>
                <form action="" method="POST" id="editUnitMagangForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" style="padding: 32px;">
                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="edit_id_unitmagang" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-identifier me-2"></i>ID Unit Magang
                            </label>
                            <input type="text" class="form-control" id="edit_id_unitmagang" name="id_unitmagang"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;" required>
                            <small class="form-text text-muted">Gunakan kode unik untuk unit magang</small>
                        </div>

                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="edit_nama_unitmagang" class="form-label"
                                style="font-weight: 600; margin-bottom: 8px; color: #374151;">
                                <i class="mdi mdi-school me-2"></i>Nama Unit Magang
                            </label>
                            <input type="text" class="form-control" id="edit_nama_unitmagang" name="nama_unitmagang"
                                style="border-radius: 8px; border: 1px solid #d1d5db; padding: 12px;" required>
                            <small class="form-text text-muted">Nama lengkap unit magang</small>
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

                $('.unitmagang-row').each(function () {
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

                $('#unitMagangCount').text(visibleCount + ' unit magang');
                $('#emptyState').toggle(visibleCount === 0);
            });

            // Edit unit magang modal
            $('.btn-edit-unitmagang').on('click', function () {
                const id = $(this).data('id');
                const idUnitMagang = $(this).data('id-unitmagang');
                const nama = $(this).data('nama');

                $('#edit_id_unitmagang').val(idUnitMagang);
                $('#edit_nama_unitmagang').val(nama);
                $('#editUnitMagangForm').attr('action', `/superadmin/unitmagang/${id}`);
            });

            // Delete confirmation
            $('.btn-delete').on('click', function () {
                const form = $(this).closest('form');

                Swal.fire({
                    title: 'Konfirmasi Penghapusan',
                    html: 'Yakin ingin menghapus data unit magang ini?<br><b>Data tidak bisa dikembalikan!</b>',
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
            $('#addUnitMagangForm').on('submit', function (e) {
                const idUnitMagang = $('#id_unitmagang').val().trim();
                const namaUnitMagang = $('#nama_unitmagang').val().trim();

                if (!idUnitMagang || !namaUnitMagang) {
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
            $('#editUnitMagangForm').on('submit', function (e) {
                const idUnitMagang = $('#edit_id_unitmagang').val().trim();
                const namaUnitMagang = $('#edit_nama_unitmagang').val().trim();

                if (!idUnitMagang || !namaUnitMagang) {
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
            $('#addUnitMagangModal').on('hidden.bs.modal', function () {
                $('#addUnitMagangForm')[0].reset();
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
