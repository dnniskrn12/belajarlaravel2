@extends('layouts.purple')

@section('content')

    <div class="container-modern">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-certificate"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Sertifikat Magang</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Informasi sertifikat Magang siswa</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'pimpinan.dashboard'], ['label' => 'Sertifikat', 'route' => 'pimpinan.sertifikat.index'],]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="search-container">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <input type="text" id="searchInput" class="search-input"
                        placeholder="Cari nama siswa atau nomor sertifikat...">
                </div>

                <div class="action-buttons">
                    <a data-bs-toggle="modal" data-bs-target="#cetakLaporanSertifikatModal"
                        class="btn-add-modern bg-gradient-success">
                        <i class="mdi mdi-printer me-1"></i> Cetak Laporan Sertifikat
                    </a>
                </div>
            </div>

            <!-- Filter Chips -->
            <div class="filter-chips">
                <span class="filter-chip active" data-filter="all">Semua</span>
                <span class="filter-chip" data-filter="tersertifikat">Tersertifikat</span>
                <span class="filter-chip" data-filter="belum-tersertifikat">Belum Tersertifikat</span>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card active">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Tersertifikat</h3>
                        <p class="number">{{ $sertifikat->whereNotNull('file_sertifikat')->count() }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-certificate"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card inactive">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Belum Tersertifikat</h3>
                        <p class="number">{{ $belumTersertifikat }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-clock-outline"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Bulan Ini</h3>
                        <p class="number">{{ $totalBulanIni }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-calendar-month"></i>
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
                    id="totalEntries">{{ count($sertifikat) }}</span> data
            </div>
        </div>

        <!-- Sertifikat Table -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Daftar Sertifikat</h3>
                <span class="employee-count" id="sertifikatCount">{{ count($sertifikat) }} sertifikat</span>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Nomor Sertifikat</th>
                            <th>Tanggal Sertifikat</th>
                            <th>Status</th>
                            <th>File Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody id="sertifikatTableBody">
                        @foreach ($sertifikat as $index => $item)
                            <tr class="sertifikat-row"
                                data-status="{{ $item->file_sertifikat ? 'tersertifikat' : 'belum-tersertifikat' }}"
                                data-search="{{ strtolower(($item->nilaiPkl->magang->nama_siswa ?? '') . ' ' . ($item->nomor_sertifikat ?? '') . ' ' . ($item->nilaiPkl->nilai_akhir ?? '')) }}">

                                <td class="row-number">{{ $index + 1 }}</td>
                                <td>
                                    <div class="employee-info">
                                        <div class="employee-avatar">
                                            {{ strtoupper(substr($item->nilaiPkl->magang->nama_siswa ?? '-', 0, 1)) }}
                                        </div>
                                        <div class="employee-details">
                                            <h4>{{ $item->nilaiPkl->magang->nama_siswa ?? 'Tidak Ada Data' }}</h4>
                                            <p>{{ $item->nilaiPkl->magang->no_magang ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if($item->nomor_sertifikat)
                                        <div class="nomor-sertifikat">
                                            <i class="mdi mdi-numeric"></i>
                                            {{ $item->nomor_sertifikat }}
                                        </div>
                                    @else
                                        <span class="text-muted">Belum diisi</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->tanggal_sertifikat)
                                        <div class="tanggal-sertifikat">
                                            <i class="mdi mdi-calendar"></i>
                                            {{ date('d M Y', strtotime($item->tanggal_sertifikat)) }}
                                        </div>
                                    @else
                                    <span class="text-muted">Belum diisi</span> @endif
                                </td>
                                <td>
                                    <span
                                        class="status-badge {{ $item->file_sertifikat ? 'status-tersertifikat' : 'status-pending' }}">
                                        {{ $item->file_sertifikat ? 'Tersertifikat' : 'Belum Lengkap' }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->file_sertifikat)
                                        <button type="button" class="btn-file-sertifikat" data-bs-toggle="modal"
                                            data-bs-target="#fileSertifikatModal{{ $item->id }}">
                                            <i class="mdi mdi-certificate"></i>
                                            Lihat Sertifikat
                                        </button>
                                    @else
                                        <span class="text-muted">Belum ada file</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="empty-state" style="display: none;">
                <i class="mdi mdi-certificate-outline"></i>
                <h3>Tidak ada data sertifikat</h3>
                <p>Tidak ada sertifikat yang sesuai dengan pencarian</p>
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

                <div id="pageNumbers" class="page-numbers" style="display: flex; gap: 4px;">
                    <!-- Page numbers will be generated by JavaScript -->
                </div>

                <button id="nextPage" class="pagination-btn"
                    style="padding: 8px 12px; border: 1px solid #d1d5db; background: white; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 4px;">
                    Selanjutnya
                    <i class="mdi mdi-chevron-right"></i>
                </button>
            </div>

        </div>
    </div>
    {{-- Modal Cetak Laporan Sertifikat --}}
    <div style="page-break-after: always;">
            <div class="modal fade" id="cetakLaporanSertifikatModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
                        <div class="modal-header"
                            style="background: linear-gradient(135deg, #3b82f6, #1e40af); color: white; border: none;">
                            <h5 class="modal-title" style="font-weight: 600;">
                                <i class="mdi mdi-printer me-2"></i>Cetak Semua Laporan Sertifikat Siswa
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                style="filter: brightness(0) invert(1);"></button>
                        </div>
                        <div class="modal-body" style="padding:0; height:80vh;">
                            <iframe src="{{ route('pimpinan.sertifikat.cetak') }}"
                                style="width:100%; height:100%; border:none;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- File Sertifikat Modals -->
    @foreach ($sertifikat as $item)
        @if($item->file_sertifikat)
            <div class="modal fade" id="fileSertifikatModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
                        <div class="modal-header"
                            style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none;">
                            <h5 class="modal-title" style="font-weight: 600;">
                                <i class="mdi mdi-certificate me-2"></i>Sertifikat Magang - {{ $item->nilaiPkl->magang->nama_siswa }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                style="filter: brightness(0) invert(1);"></button>
                        </div>
                        <div class="modal-body text-center" style="padding: 32px;">
                            @php
                                $extension = strtolower(pathinfo($item->file_sertifikat, PATHINFO_EXTENSION));
                            @endphp

                            @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ asset('storage/sertifikat_pkl/' . $item->file_sertifikat) }}"
                                    alt="Sertifikat {{ $item->nilaiPkl->nama_siswa }}" class="img-fluid"
                                    style="max-width: 100%; max-height: 70vh; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.1);">
                            @elseif($extension === 'pdf')
                                <div class="pdf-viewer" style="height: 70vh;">
                                    <embed src="{{ asset('storage/sertifikat_pkl/' . $item->file_sertifikat) }}" type="application/pdf"
                                        style="width: 100%; height: 100%; border-radius: 12px;">
                                </div>
                            @else
                                <div class="file-download" style="text-align: center; padding: 40px;">
                                    <i class="mdi mdi-certificate" style="font-size: 64px; color: #f59e0b; margin-bottom: 16px;"></i>
                                    <h4>File tidak dapat ditampilkan</h4>
                                    <p class="text-muted">Klik tombol download untuk mengunduh sertifikat</p>
                                    <a href="{{ asset('storage/sertifikat_pkl/' . $item->file_sertifikat) }}" class="btn btn-warning"
                                        download>
                                        <i class="mdi mdi-download me-2"></i>Download Sertifikat
                                    </a>
                                </div>
                            @endif

                            <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                                <div class="sertifikat-info"
                                    style="display: flex; justify-content: center; gap: 32px; flex-wrap: wrap;">
                                    <div class="info-item">
                                        <strong>Nama Siswa:</strong><br>
                                        {{ $item->nilaiPkl->magang->nama_siswa }}

                                    </div>
                                    <div class="info-item">
                                        <strong>Nilai Magang:</strong><br>
                                        {{ $item->nilaiPkl->nilai_akhir }}
                                    </div>
                                    @if($item->nomor_sertifikat)
                                        <div class="info-item">
                                            <strong>Nomor:</strong><br>
                                            {{ $item->nomor_sertifikat }}
                                        </div>
                                    @endif
                                    @if($item->tanggal_sertifikat)
                                        <div class="info-item">
                                            <strong>Tanggal:</strong><br>
                                            {{ date('d M Y', strtotime($item->tanggal_sertifikat)) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
                filterSertifikat();
            });

            // Filter chips
            $('.filter-chip').on('click', function () {
                $('.filter-chip').removeClass('active');
                $(this).addClass('active');
                currentPage = 1;
                filterSertifikat();
            });

            $('#entriesPerPage').on('change', function () {
                entriesPerPage = parseInt($(this).val());
                currentPage = 1;
                filterSertifikat();
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

            function filterSertifikat() {
                const searchTerm = $('#searchInput').val().toLowerCase();
                const activeFilter = $('.filter-chip.active').data('filter');
                filteredRows = [];

                $('.sertifikat-row').each(function () {
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
                $('.sertifikat-row').hide();

                const startIndex = (currentPage - 1) * entriesPerPage;
                const endIndex = Math.min(startIndex + entriesPerPage, filteredRows.length);

                for (let i = startIndex; i < endIndex; i++) {
                    const $row = filteredRows[i];
                    $row.show();
                    $row.find('.row-number').text(i + 1);
                }

                updatePaginationInfo();
                updatePaginationButtons();
                $('#emptyState').toggle(filteredRows.length === 0);
            }

            function updatePaginationInfo() {
                const startIndex = filteredRows.length === 0 ? 0 : (currentPage - 1) * entriesPerPage + 1;
                const endIndex = Math.min(currentPage * entriesPerPage, filteredRows.length);

                $('#showingStart').text(startIndex);
                $('#showingEnd').text(endIndex);
                $('#totalEntries').text(filteredRows.length);
                $('#sertifikatCount').text(filteredRows.length + ' sertifikat');
            }

            function updatePaginationButtons() {
                const totalPages = Math.ceil(filteredRows.length / entriesPerPage);

                $('#prevPage').prop('disabled', currentPage === 1);
                $('#nextPage').prop('disabled', currentPage === totalPages || totalPages === 0);

                const $pageNumbers = $('#pageNumbers');
                $pageNumbers.empty();

                if (totalPages <= 7) {
                    for (let i = 1; i <= totalPages; i++) {
                        $pageNumbers.append(createPageButton(i));
                    }
                } else {
                    $pageNumbers.append(createPageButton(1));

                    if (currentPage > 4) {
                        $pageNumbers.append('<span style="padding: 8px 4px;">...</span>');
                    }

                    const start = Math.max(2, currentPage - 1);
                    const end = Math.min(totalPages - 1, currentPage + 1);

                    for (let i = start; i <= end; i++) {
                        $pageNumbers.append(createPageButton(i));
                    }

                    if (currentPage < totalPages - 3) {
                        $pageNumbers.append('<span style="padding: 8px 4px;">...</span>');
                    }

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
                    html: 'Yakin ingin menghapus data sertifikat ini?<br><b>Data tidak bisa dikembalikan!</b>',
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

            // Show success/error messages
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

            // Initialize
            filterSertifikat();
        });
    </script>
@endsection
