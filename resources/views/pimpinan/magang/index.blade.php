@extends('layouts.purple')

@section('content')

    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-account-school"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Data Magang</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Informasi magang untuk pimpinan</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'pimpinan.dashboard'], ['label' => 'Laporan Magang', 'route' => 'pimpinan.magang.index'],]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="search-container">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari nama atau nomor magang...">
                </div>
                <div class="action-buttons">
                    <a data-bs-toggle="modal" data-bs-target="#cetakLaporanMagangModal"
                        class="btn-add-modern bg-gradient-success">
                        <i class="mdi mdi-printer me-1"></i> Cetak Laporan Magang
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
                        <h3>Total Magang</h3>
                        <p class="number">{{ count($magang) }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-account-group"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card active">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Magang Aktif</h3>
                        <p class="number">{{ $magang->where('status_magang', 'Aktif')->count() }}</p>
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
                        <p class="number">{{ $magang->where('status_magang', '!=', 'Aktif')->count() }}</p>
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
                    id="totalEntries">{{ count($magang) }}</span> data
            </div>
        </div>
        <!-- Employee Table -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Daftar Magang</h3>
                <span class="employee-count" id="employeeCount">{{ count($magang) }} magang</span>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Magang</th>
                            <th>Informasi Personal</th>
                            <th>Kontak</th>
                            <th>Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTableBody">
                        @foreach ($magang as $index => $item)
                            <tr class="employee-row" data-status="{{ strtolower($item->status_magang) }}"
                                data-search="{{ strtolower($item->nama_siswa . ' ' . $item->no_magang . ' ' . $item->email) }}">
                                <td class="row-number">{{ $index + 1 }}</td>
                                <td>
                                    <div class="employee-info">
                                        <div class="employee-avatar">
                                            {{ strtoupper(substr($item->nama_siswa, 0, 1)) }}
                                        </div>
                                        <div class="employee-details">
                                            <h4>{{ $item->nama_siswa }}</h4>
                                            <p>{{ $item->no_magang }}</p>
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
                                        class="status-badge {{ $item->status_magang == 'Aktif' ? 'status-active' : 'status-inactive' }}">
                                        {{ $item->status_magang }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons-table">
                                        <a href="{{route('pimpinan.magang.show', $item->id)}}" class="action-btn-table view"
                                            title="Detail">
                                            <i class="mdi mdi-account-details"></i>
                                        </a>

                                        <a data-bs-toggle="modal" data-bs-target="#cetakMagangModal{{ $item->id}}"
                                            class="action-btn-table download" title="Cetak">
                                            <i class="mdi mdi-printer"></i>
                                        </a>
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
                <h3>Tidak ada data magang</h3>
                <p>Tidak ada magang yang sesuai dengan pencarian</p>
            </div>
        </div>
    </div>

    <!-- Modal Cetak Laporan Magang -->
    <div style="page-break-after: always;">
        <div class="modal fade" id="cetakLaporanMagangModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
                    <div class="modal-header"
                        style="background: linear-gradient(135deg, #3b82f6, #1e40af); color: white; border: none;">
                        <h5 class="modal-title" style="font-weight: 600;">
                            <i class="mdi mdi-printer me-2"></i>Cetak Semua Laporan Siswa Magang
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            style="filter: brightness(0) invert(1);"></button>
                    </div>
                    <div class="modal-body" style="padding:0; height:80vh;">
                        <iframe src="{{ route('pimpinan.magang.cetak') }}"
                            style="width:100%; height:100%; border:none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Cetak 1 Magang --}}
    @foreach ($magang as $item)
        <div class="modal fade" id="cetakMagangModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
                    <div class="modal-header"
                        style="background: linear-gradient(135deg, #3b82f6, #1e40af); color: white; border: none;">
                        <h5 class="modal-title" style="font-weight: 600;">
                            <i class="mdi mdi-printer me-2"></i>Cetak Biodata Magang - {{ $item->nama_siswa }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            style="filter: brightness(0) invert(1);"></button>
                    </div>
                    <div class="modal-body p-0" style="height: 80vh;">
                        <iframe src="{{ route('pimpinan.magang.cetakSatu', $item->id) }}"
                            style="width:100%; height:100%; border:none;"></iframe>
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
                $('#employeeCount').text(filteredRows.length + ' magang');
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

            filterEmployees();
        });
    </script>
@endsection
