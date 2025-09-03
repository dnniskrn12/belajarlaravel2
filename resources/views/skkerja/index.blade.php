@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <!-- Header -->
        <div class="header-section">
            <div class="header-top" style="display: flex; justify-content: space-between; align-items: center;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-file-document"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern">Data SK Kerja</h1>
                        <p class="page-subtitle-modern">Kelola semua SK Kerja pegawai</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'superadmin.dashboard'], ['label' => 'SK Kerja', 'route' => 'superadmin.sk_kerja.index']]" />
                </div>
            </div>

            <div class="action-bar">
                <div class="search-container">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <input type="text" id="searchInput" class="search-input"
                        placeholder="Cari nomor SK atau nama pegawai...">
                </div>
                <div class="action-buttons">
                    <a href="{{ route('superadmin.sk_kerja.create') }}" class="btn-add-modern bg-gradient-primary">
                        <i class="mdi mdi-plus"></i> Tambah SK
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Total SK</h3>
                        <p class="number">{{ count($skKerja) }}</p>
                    </div>
                    <div class="stat-icon"><i class="mdi mdi-file-document"></i></div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Daftar SK Kerja</h3>
                <span class="employee-count" id="skCount">{{ count($skKerja) }} SK</span>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor SK</th>
                            <th>Nomor Pegawai</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal SK</th>
                            <th>Lokasi</th>
                            <th>Unit Kerja</th>
                            <th>Jabatan</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="skTableBody">
                        @foreach($skKerja as $index => $sk)
                            <tr class="sk-row"
                                data-search="{{ strtolower($sk->no_sk . ' ' . $sk->no_pegawai . ' ' . $sk->nama_pegawai) }}">
                                <td class="row-number">{{ $index + 1 }}</td>
                                <td>{{ $sk->no_sk }}</td>
                                <td>{{ $sk->no_pegawai }}</td>
                                <td>{{ $sk->nama_pegawai }}</td>
                                <td>{{ \Carbon\Carbon::parse($sk->tgl_sk)->format('d-m-Y') }}</td>
                                <td>{{ $sk->lokasi?->nama_lokasi }}</td>
                                <td>{{ $sk->unitkerja?->nama_unitkerja }}</td>
                                <td>{{ $sk->jabatan?->nama_jabatan }}</td>
                                <td>
                                    <div class="action-buttons-table">
                                        <a href="{{ route('superadmin.sk_kerja.edit', $sk->id) }}" class="action-btn-table edit" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('superadmin.sk_kerja.destroy', $sk->id) }}" method="POST"
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
                <i class="mdi mdi-file-search"></i>
                <h3>Tidak ada data SK Kerja</h3>
                <p>Tidak ada SK Kerja yang sesuai dengan pencarian</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            // Search filter
            $('#searchInput').on('input', function () {
                let search = $(this).val().toLowerCase();
                let visible = 0;
                $('.sk-row').each(function () {
                    let match = $(this).data('search').includes(search);
                    $(this).toggle(match);
                    if (match) visible++;
                });
                $('#skCount').text(visible + ' SK');
                $('#emptyState').toggle(visible === 0);
            });

            // Delete confirm
            $('.btn-delete').on('click', function () {
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'SK Kerja akan dihapus permanen!',
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
        });
    </script>
@endsection
