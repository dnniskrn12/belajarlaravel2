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
                        <h1 class="page-title-modern" style="margin:0;">Nilai Magang</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Kelola nilai magang siswa</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Nilai Magang', 'route' => 'admin.nilaipkl.index'],]" />
                </div>
            </div>
            <div class="action-bar">
                <div class="search-container">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari nama siswa atau nilai...">
                </div>

                <div class="action-buttons">
                    <a href="{{ route('admin.nilaipkl.create') }}" class="btn-add-modern bg-gradient-primary">
                        <i class="mdi mdi-plus"></i>
                        Tambah Nilai Magang
                    </a>
                </div>
            </div>

            <!-- Filter Chips -->
            <div class="filter-chips">
                <span class="filter-chip active" data-filter="all">Semua</span>
                <span class="filter-chip" data-filter="lulus">Lulus (≥70)</span>
                <span class="filter-chip" data-filter="tidak-lulus">Tidak Lulus (≤70)</span>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Total Siswa Magang</h3>
                        <p class="number">{{ count($nilaiPkl) }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-school"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card active">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Lulus Magang</h3>
                        <p class="number">{{ $nilaiPkl->where('nilai_akhir', '>=', 70)->count() }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-check-circle"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card inactive">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Belum Lulus</h3>
                        <p class="number">{{ $nilaiPkl->where('nilai_akhir', '<', 70)->count() }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-alert-circle"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>Rata-rata Nilai</h3>
                        <p class="number">
                            {{ $nilaiPkl->avg('nilai_akhir') ? number_format($nilaiPkl->avg('nilai_akhir'), 1) : '0' }}
                        </p>
                    </div>
                    <div class="stat-icon">
                        <i class="mdi mdi-chart-line"></i>
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
                    id="totalEntries">{{ count($nilaiPkl) }}</span> data
            </div>
        </div>

        <!-- Nilai Magang Table -->
        <div class="data-card">
            <div class="card-header-clean">
                <h3 class="card-title-clean">Daftar Nilai Magang</h3>
                <span class="employee-count" id="nilaiCount">{{ count($nilaiPkl) }} siswa</span>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Nilai Magang</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th>File Scan</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="nilaiTableBody">
                        @forelse ($nilaiPkl as $index => $item)
                            <tr class="nilai-row" data-status="{{ $item->nilai_akhir >= 70 ? 'lulus' : 'tidak-lulus' }}"
                                data-search="{{ strtolower($item->magang->nama_siswa . ' ' . $item->nilai_akhir . ' ' . $item->catatan) }}">

                                <td class="row-number">{{ $index + 1 }}</td>
                                <td>
                                    <div class="employee-info">
                                        <div class="employee-avatar">
                                            {{ strtoupper(substr($item->magang->nama_siswa, 0, 1)) }}
                                        </div>
                                        <div class="employee-details">
                                            <h4>{{ $item->magang->nama_siswa }}</h4>
                                            <p>{{ $item->no_magang }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="nilai-display">
                                        <span
                                            class="nilai-badge {{ $item->nilai_akhir >= 70 ? 'nilai-lulus' : 'nilai-tidak-lulus' }}">
                                            {{ $item->nilai_akhir }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="status-badge {{ $item->nilai_akhir >= 70 ? 'status-active' : 'status-inactive' }}">
                                        {{ $item->nilai_akhir >= 70 ? 'Lulus' : 'Tidak Lulus' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="catatan-info">
                                        @if($item->catatan)
                                            <p class="catatan-text">{{ Str::limit($item->catatan, 50) }}</p>
                                            @if(strlen($item->catatan) > 50)
                                                <button type="button" class="btn-detail-catatan" data-catatan="{{ $item->catatan }}"
                                                    data-nama="{{ $item->magang->nama_siswa }}" data-bs-toggle="modal"
                                                    data-bs-target="#catatanModal">
                                                    Lihat selengkapnya
                                                </button>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($item->file_scan_nilai)
                                        <!-- Tombol Preview Modal -->
                                        <button type="button" class="btn-file-scan" data-bs-toggle="modal"
                                            data-bs-target="#fileScanModal{{ $item->id }}">
                                            <i class="mdi mdi-file-document"></i>
                                            Lihat File
                                        </button>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="action-buttons-table">
                                        <a href="{{ route('admin.nilaipkl.show', $item->id) }}" class="action-btn-table view"
                                            title="Detail">
                                            <i class="mdi mdi-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.nilaipkl.edit', $item->id) }}" class="action-btn-table edit"
                                            title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.nilaipkl.destroy', $item->id) }}" method="POST"
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

                        @endforelse
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

                <div id="pageNumbers" class="page-numbers" style="display: flex; gap: 4px;">
                    <!-- Page numbers will be generated by JavaScript -->
                </div>

                <button id="nextPage" class="pagination-btn"
                    style="padding: 8px 12px; border: 1px solid #d1d5db; background: white; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 4px;">
                    Selanjutnya
                    <i class="mdi mdi-chevron-right"></i>
                </button>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="empty-state" style="display: none;">
                <i class="mdi mdi-school-outline"></i>
                <h3>Tidak ada data nilai Magang</h3>
                <p>Tidak ada nilai Magang yang sesuai dengan pencarian</p>
            </div>
        </div>
    </div>

    <!-- Catatan Modal -->
    <div class="modal fade" id="catatanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; border: none;">
                    <h5 class="modal-title" style="font-weight: 600;">
                        <i class="mdi mdi-note-text me-2"></i>Catatan Magang - <span id="catatanNamaSiswa"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body" style="padding: 32px;">
                    <div class="catatan-full" id="catatanFull" style="line-height: 1.6; color: #374151;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- File Scan Modals -->
    @foreach ($nilaiPkl as $item)
        @if($item->file_scan_nilai)
            <div class="modal fade" id="fileScanModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
                        <div class="modal-header"
                            style="background: linear-gradient(135deg, #516bff, #1a28e9); color: white; border: none;">
                            <h5 class="modal-title" style="font-weight: 600;">
                                <i class="mdi mdi-file-document me-2"></i>File Scan Nilai - {{ $item->magang->nama_siswa }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                style="filter: brightness(0) invert(1);"></button>
                        </div>
                        <div class="modal-body text-center" style="padding: 32px;">
                            @php
                                $extension = strtolower(pathinfo($item->file_scan_nilai, PATHINFO_EXTENSION));
                            @endphp

                            @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ asset('storage/scan_nilai_pkl/' . $item->file_scan_nilai) }}"
                                    alt="Scan Nilai {{ $item->magang->nama_siswa }}" class="img-fluid"
                                    style="max-width: 100%; max-height: 70vh; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.1);">
                            @elseif($extension === 'pdf')
                                <div class="pdf-viewer" style="height: 70vh;">
                                    <embed src="{{ asset('storage/scan_nilai_pkl/' . $item->file_scan_nilai) }}" type="application/pdf"
                                        style="width: 100%; height: 100%; border-radius: 12px;">
                                </div>
                            @else
                                <div class="file-download" style="text-align: center; padding: 40px;">
                                    <i class="mdi mdi-file-download" style="font-size: 64px; color: #516bff; margin-bottom: 16px;"></i>
                                    <h4>File tidak dapat ditampilkan</h4>
                                    <p class="text-muted">Klik tombol download untuk mengunduh file</p>
                                    <a href="{{ asset('storage/scan_nilai_pkl/' . $item->file_scan_nilai) }}" class="btn btn-success"
                                        download>
                                        <i class="mdi mdi-download me-2"></i>Download File
                                    </a>
                                </div>
                            @endif

                            <div style="margin-top: 16px;">
                                <h6 style="margin-bottom: 4px; font-weight: 600;">{{ $item->magang->nama_siswa }}</h6>
                                <small style="color: #6b7280;">Nilai: {{ $item->nilai_akhir }}</small>
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
                filterNilai();
            });

            // Filter chips
            $('.filter-chip').on('click', function () {
                $('.filter-chip').removeClass('active');
                $(this).addClass('active');
                currentPage = 1;
                filterNilai();
            });

            $('#entriesPerPage').on('change', function () {
                entriesPerPage = parseInt($(this).val());
                currentPage = 1;
                filterNilai();
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

            function filterNilai() {
                const searchTerm = $('#searchInput').val().toLowerCase();
                const activeFilter = $('.filter-chip.active').data('filter');
                filteredRows = [];

                $('.nilai-row').each(function () {
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
                $('.nilai-row').hide();

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
                $('#nilaiCount').text(filteredRows.length + ' siswa');
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

            // Catatan modal
            $('.btn-detail-catatan').on('click', function () {
                const catatan = $(this).data('catatan');
                const nama = $(this).data('nama');

                $('#catatanNamaSiswa').text(nama);
                $('#catatanFull').text(catatan);
            });

            // Delete confirmation
            $('.btn-delete').on('click', function () {
                const form = $(this).closest('form');

                Swal.fire({
                    title: 'Konfirmasi Penghapusan',
                    html: 'Yakin ingin menghapus data nilai Magang ini?<br><b>Data tidak bisa dikembalikan!</b>',
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

            // Initialize
            filterNilai();
        });
    </script>
@endsection
