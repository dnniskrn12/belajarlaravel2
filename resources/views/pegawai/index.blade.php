@extends('layouts.purple')

@section('content')

    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-account-group"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Data Pegawai</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Kelola informasi pegawai perusahaan</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[
                        ['label' => 'Dashboard', 'route' => 'home'],
                        ['label' => 'Pegawai', 'route' => 'pegawai.index'],
                    ]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="search-container">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari nama atau nomor pegawai...">
                </div>

                <div class="action-buttons">
                    <a href="{{ route('pegawai.create') }}" class="btn-add-modern bg-gradient-primary">
                        <i class="mdi mdi-plus"></i>
                        Tambah Pegawai
                    </a>
                </div>
            </div>

            <!-- Baris ketiga: Filter Chips -->
            <div class="filter-chips">
                <span class="filter-chip active" data-filter="all">Semua</span>
                <span class="filter-chip" data-filter="aktif">Aktif</span>
                <span class="filter-chip" data-filter="non aktif">Tidak Aktif</span>
            </div>

        </div>



        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Total Pegawai</h3>
                        <p class="number">{{ count($pegawai) }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-account-group"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card active">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Pegawai Aktif</h3>
                        <p class="number">{{ $pegawai->where('status_pekerjaan', 'Aktif')->count() }}</p>
                    </div>
                    <div class="stat-icon">
                        <div style="width: 12px; height: 12px; background: white; border-radius: 50%;"></div>
                    </div>
                </div>
            </div>

            <div class="stat-card inactive">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Tidak Aktif</h3>
                        <p class="number">{{ $pegawai->where('status_pekerjaan', '!=', 'Aktif')->count() }}</p>
                    </div>
                    <div class="stat-icon">
                        <div style="width: 12px; height: 12px; background: white; border-radius: 50%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employee Table -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Daftar Pegawai</h3>
                <span class="employee-count" id="employeeCount">{{ count($pegawai) }} pegawai</span>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pegawai</th>
                            <th>Informasi Personal</th>
                            <th>Kontak</th>
                            <th>Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTableBody">
                        @foreach ($pegawai as $index => $item)
                            <tr class="employee-row" data-status="{{ strtolower($item->status_pekerjaan) }}"
                                data-search="{{ strtolower($item->nama_pegawai . ' ' . $item->no_pegawai . ' ' . $item->email) }}">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="employee-info">
                                        <div class="employee-avatar">
                                            {{ strtoupper(substr($item->nama_pegawai, 0, 1)) }}
                                        </div>
                                        <div class="employee-details">
                                            <h4>{{ $item->nama_pegawai }}</h4>
                                            <p>{{ $item->no_pegawai }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="personal-info">
                                        @if(isset($item->tempat_lahir))
                                            <div class="info-row">
                                                <i class="mdi mdi-map-marker"></i>
                                                {{ $item->tempat_lahir }}
                                            </div>
                                        @endif
                                        @if(isset($item->tgl_lahir))
                                            <div class="info-row">
                                                <i class="mdi mdi-calendar"></i>
                                                {{ date('d M Y', strtotime($item->tgl_lahir)) }}
                                            </div>
                                        @endif
                                        <div class="gender">{{ $item->jenis_kelamin }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="contact-info">
                                        <i class="mdi mdi-email"></i>
                                        {{ $item->email }}
                                    </div>
                                    @if(isset($item->no_hp))
                                        <div class="contact-info" style="margin-top: 4px;">
                                            <i class="mdi mdi-phone"></i>
                                            {{ $item->no_hp }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="status-badge {{ $item->status_pekerjaan == 'Aktif' ? 'status-active' : 'status-inactive' }}">
                                        {{ $item->status_pekerjaan }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons-table">
                                        <button type="button" class="action-btn-table view" data-bs-toggle="modal"
                                            data-bs-target="#modalfoto{{ $item->no_pegawai}}" title="Lihat Foto">
                                            <i class="mdi mdi-eye"></i>
                                        </button>

                                        <a href="{{route('pegawai.show', $item->id)}}" class="action-btn-table view"
                                            title="Detail">
                                            <i class="mdi mdi-account-details"></i>
                                        </a>

                                        <a href="{{ route('pegawai.edit', $item->id) }}" class="action-btn-table edit"
                                            title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <form action="{{ route('pegawai.destroy', $item->id) }}" method="POST"
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
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="empty-state" style="display: none;">
                <i class="mdi mdi-account-search"></i>
                <h3>Tidak ada data pegawai</h3>
                <p>Tidak ada pegawai yang sesuai dengan pencarian</p>
            </div>
        </div>
    </div>

    <!-- Photo Modals -->
    @foreach ($pegawai as $item)
        <div class="modal fade" id="modalfoto{{$item->no_pegawai}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
                    <div class="modal-header"
                        style="background: linear-gradient(135deg, #d58df7, #a31dd8); color: white; border: none;">
                        <h5 class="modal-title" style="font-weight: 600;">
                            <i class="mdi mdi-account-circle me-2"></i>{{ $item->nama_pegawai }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            style="filter: brightness(0) invert(1);"></button>
                    </div>
                    <div class="modal-body text-center" style="padding: 32px;">
                        <img src="{{ asset('storage/foto_pegawai/' . $item->foto) }}" alt="Foto {{ $item->nama_pegawai }}"
                            class="img-fluid"
                            style="max-width: 300px; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.1);">
                        <div style="margin-top: 16px;">
                            <h6 style="margin-bottom: 4px; font-weight: 600;">{{ $item->nama_pegawai }}</h6>
                            <small style="color: #6b7280;">{{ $item->no_pegawai }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            // Search functionality
            $('#searchInput').on('input', function () {
                filterEmployees();
            });

            // Filter chips
            $('.filter-chip').on('click', function () {
                $('.filter-chip').removeClass('active');
                $(this).addClass('active');
                filterEmployees();
            });

            function filterEmployees() {
                const searchTerm = $('#searchInput').val().toLowerCase();
                const activeFilter = $('.filter-chip.active').data('filter');
                let visibleCount = 0;

                $('.employee-row').each(function () {
                    const $row = $(this);
                    const searchData = $row.data('search');
                    const status = $row.data('status');

                    let matchesSearch = !searchTerm || searchData.includes(searchTerm);
                    let matchesFilter = activeFilter === 'all' || status === activeFilter;

                    if (matchesSearch && matchesFilter) {
                        $row.show();
                        visibleCount++;
                    } else {
                        $row.hide();
                    }
                });

                // Update count and show/hide empty state
                $('#employeeCount').text(visibleCount + ' pegawai');
                $('#emptyState').toggle(visibleCount === 0);
            }

            // Delete confirmation
            $('.btn-delete').on('click', function () {
                const form = $(this).closest('form');

                Swal.fire({
                    title: 'Konfirmasi Penghapusan',
                    html: 'Yakin ingin menghapus data pegawai?<br><b>Data tidak bisa dikembalikan!</b>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Initialize filter count
            filterEmployees();
        });
    </script>

@endsection
@push('scripts')

@endpush
