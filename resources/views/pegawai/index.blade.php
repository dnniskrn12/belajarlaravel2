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
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Pegawai', 'route' => 'admin.pegawai.index'],]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="search-container">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari nama atau nomor pegawai...">
                </div>

                <div class="action-buttons">
                    <a href="{{ route('admin.pegawai.create') }}" class="btn-add-modern bg-gradient-primary">
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
                        <i class="mdi mdi-checkbox-marked-circle-outline"></i>
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
                        <i class="mdi mdi-close-octagon-outline"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Added pagination controls -->
        <div class="pagination-controls"
            style="display: flex; align-items: center; gap: 16px; margin-top: 16px; justify-content: space-between; margin-top: 16px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="color: #6b7280; font-size: 14px;">Tampilkan:</span>
                <select id="entriesPerPage" class="form-select"
                    style="width: auto; min-width: 80px; padding: 6px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                    <option value="10" selected>10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span style="color: #6b7280; font-size: 14px;">data</span>
            </div>

            <div class="pagination-info" style="color: #6b7280; font-size: 14px;">
                Menampilkan <span id="showingStart">1</span> sampai <span id="showingEnd">10</span> dari <span
                    id="totalEntries">{{ count($pegawai) }}</span> data
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
                                <td class="row-number">{{ $index + 1 }}</td>
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

                                        <a href="{{route('admin.pegawai.show', $item->id)}}" class="action-btn-table view"
                                            title="Detail">
                                            <i class="mdi mdi-account-details"></i>
                                        </a>

                                        <a href="{{ route('admin.pegawai.edit', $item->id) }}" class="action-btn-table edit"
                                            title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.pegawai.destroy', $item->id) }}" method="POST"
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

            <!-- Added pagination navigation -->
            <div class="pagination-nav"
                style="display: flex; justify-content: center; align-items: center; gap: 8px; margin-top: 24px; padding: 16px 0;">
                <button id="prevPage" class="pagination-btn"
                    style="padding: 8px 12px; border: 1px solid #d1d5db; background: white; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 4px;"
                    disabled>
                    <i class="mdi mdi-chevron-left"></i>
                    Sebelumnya
                </button>

                <div id="pageNumbers" class="page-numbers" style="display: flex; gap: 4px;"></div>

                <button id="nextPage" class="pagination-btn"
                    style="padding: 8px 12px; border: 1px solid #d1d5db; background: white; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 4px;">
                    Selanjutnya
                    <i class="mdi mdi-chevron-right"></i>
                </button>
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
            let currentPage = 1;
            let entriesPerPage = 10;
            let filteredRows = [];

            // Search functionality
            $('#searchInput').on('input', function () {
                filterEmployees();
            });

            // Filter chips
            $('.filter-chip').on('click', function () {
                $('.filter-chip').removeClass('active');
                $(this).addClass('active');
                currentPage = 1; // Reset to first page when filtering
                filterEmployees();
            });

            $('#entriesPerPage').on('change', function () {
                entriesPerPage = parseInt($(this).val());
                currentPage = 1; // Reset to first page
                filterEmployees();
            });

            $('#prevPage').on('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    displayPage();
                }
            });

            $('#nextPage').on('click', function () {
                const totalPages = Math.ceil(filteredRows.length / entriesPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    displayPage();
                }
            });

            function filterEmployees() {
                const searchTerm = $('#searchInput').val().toLowerCase();
                const activeFilter = $('.filter-chip.active').data('filter');
                filteredRows = [];

                $('.employee-row').each(function () {
                    const $row = $(this);
                    const searchData = $row.data('search');
                    const status = $row.data('status');

                    let matchesSearch = !searchTerm || searchData.includes(searchTerm);
                    let matchesFilter = activeFilter === 'all' || status === activeFilter;

                    if (matchesSearch && matchesFilter) {
                        filteredRows.push($row);
                    }
                });

                displayPage();
            }

            function displayPage() {
                // Hide all rows first
                $('.employee-row').hide();

                // Calculate start and end indices
                const startIndex = (currentPage - 1) * entriesPerPage;
                const endIndex = Math.min(startIndex + entriesPerPage, filteredRows.length);

                // Show rows for current page and update row numbers
                for (let i = startIndex; i < endIndex; i++) {
                    const $row = filteredRows[i];
                    $row.show();
                    $row.find('.row-number').text(i + 1);
                }

                // Update pagination info
                updatePaginationInfo();
                updatePaginationButtons();

                // Show/hide empty state
                $('#emptyState').toggle(filteredRows.length === 0);
            }

            function updatePaginationInfo() {
                const startIndex = filteredRows.length === 0 ? 0 : (currentPage - 1) * entriesPerPage + 1;
                const endIndex = Math.min(currentPage * entriesPerPage, filteredRows.length);

                $('#showingStart').text(startIndex);
                $('#showingEnd').text(endIndex);
                $('#totalEntries').text(filteredRows.length);
                $('#employeeCount').text(filteredRows.length + ' pegawai');
            }

            function updatePaginationButtons() {
                const totalPages = Math.ceil(filteredRows.length / entriesPerPage);

                // Update prev/next buttons
                $('#prevPage').prop('disabled', currentPage === 1);
                $('#nextPage').prop('disabled', currentPage === totalPages || totalPages === 0);

                // Generate page numbers
                const $pageNumbers = $('#pageNumbers');
                $pageNumbers.empty();

                if (totalPages <= 7) {
                    // Show all pages if 7 or fewer
                    for (let i = 1; i <= totalPages; i++) {
                        $pageNumbers.append(createPageButton(i));
                    }
                } else {
                    // Show first page
                    $pageNumbers.append(createPageButton(1));

                    if (currentPage > 4) {
                        $pageNumbers.append('<span style="padding: 8px 4px;">...</span>');
                    }

                    // Show pages around current page
                    const start = Math.max(2, currentPage - 1);
                    const end = Math.min(totalPages - 1, currentPage + 1);

                    for (let i = start; i <= end; i++) {
                        $pageNumbers.append(createPageButton(i));
                    }

                    if (currentPage < totalPages - 3) {
                        $pageNumbers.append('<span style="padding: 8px 4px;">...</span>');
                    }

                    // Show last page
                    if (totalPages > 1) {
                        $pageNumbers.append(createPageButton(totalPages));
                    }
                }
            }

            function createPageButton(pageNum) {
                const isActive = pageNum === currentPage;
                const buttonStyle = isActive
                    ? 'padding: 8px 12px; border: 1px solid #d58df7; background: #d58df7; color: white; border-radius: 6px; cursor: pointer; min-width: 40px; text-align: center;'
                    : 'padding: 8px 12px; border: 1px solid #d1d5db; background: white; color: #374151; border-radius: 6px; cursor: pointer; min-width: 40px; text-align: center;';

                return $(`<button class="page-btn" data-page="${pageNum}" style="${buttonStyle}">${pageNum}</button>`)
                    .on('click', function () {
                        currentPage = pageNum;
                        displayPage();
                    });
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

            filterEmployees();
        });
    </script>
@endsection

