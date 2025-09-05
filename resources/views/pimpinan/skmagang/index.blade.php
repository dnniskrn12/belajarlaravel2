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
                        <h1 class="page-title-modern">Data SK Magang</h1>
                        <p class="page-subtitle-modern">Informasi SK Siswa Magang untuk Pimpinan</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'pimpinan.dashboard'], ['label' => 'Laporan SK Magang', 'route' => 'pimpinan.sksiswa.index']]" />
                </div>
            </div>

            <div class="action-bar">
                <div class="search-container">
                    <i class="mdi mdi-magnify search-icon"></i>
                    <input type="text" id="searchInput" class="search-input"
                        placeholder="Cari nomor SK atau nama magang...">
                </div>
                <div class="action-buttons">
                    <a data-bs-toggle="modal" data-bs-target="#cetakLaporanSKMagangModal"
                        class="btn-add-modern bg-gradient-success">
                        <i class="mdi mdi-printer me-1"></i> Cetak Laporan SK Magang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid" style="grid-template-columns: 500px;">
        <div class="stat-card total">
            <div class="stat-content">
                <div class="stat-info">
                    <h3>Total SK Magang</h3>
                    <p class="number">{{ count($sk) }}</p>
                </div>
                <div class="stat-icon"><i class="mdi mdi-file-document"></i></div>
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
                id="totalEntries">{{ count($sk) }}</span> data
        </div>
    </div>
    <!-- Table -->
    <div class="data-card">
        <div class="card-header-clean">
            <h3 class="card-title-clean">Daftar SK Magang</h3>
            <span class="employee-count" id="skCount">{{ count($sk) }} SK</span>
        </div>

        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor SK</th>
                        <th>Nama Siswa Magang</th>
                        <th>Tanggal SK</th>
                        <th>Unit Magang</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="skTableBody">
                    @forelse($sk as $index => $item)
                        <tr class="sk-row"
                            data-search="{{ strtolower($item->no_sk . ' ' . $item->no_magang . ' ' . $item->nama_siswa) }}">
                            <td class="row-number">{{ $index + 1 }}</td>
                            <td>{{ $item->no_sk }}</td>
                            <td>
                                <div class="employee-info">

                                    <div class="employee-details">
                                        <h4>{{ $item->nama_siswa }}</h4>
                                        <p>{{ $item->no_magang }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_sk)->format('d-m-Y') }}</td>
                            <td>{{ $item->unit_magang?->nama_unitmagang }}</td>
                            <td>
                                <div class="action-buttons-table">
                                    <a data-bs-toggle="modal" data-bs-target="#cetakSKMagangModal{{ $item->id}}"
                                        class="action-btn-table download" title="Cetak">
                                        <i class="mdi mdi-printer"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" align="center">
                                <div class="empty-state">
                                    <i class="mdi mdi-file-search"></i>
                                    <h3>Tidak ada data SK Magang</h3>
                                    <p>Silakan tambahkan data baru terlebih dahulu</p>
                                </div>
                            </td>
                        </tr>
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

            <div id="pageNumbers" class="page-numbers" style="display: flex; gap: 4px;"></div>

            <button id="nextPage" class="pagination-btn"
                style="padding: 8px 12px; border: 1px solid #d1d5db; background: white; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 4px;">
                Selanjutnya
                <i class="mdi mdi-chevron-right"></i>
            </button>
        </div>
    </div>
    </div>
    {{-- Modal Cetak Laporan --}}
    <div style="page-break-after: always;">
        <div class="modal fade" id="cetakLaporanSKMagangModal" tabindex="-1" aria-hidden="true">
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
                        <iframe src="{{ route('pimpinan.sksiswa.cetak') }}"
                            style="width:100%; height:100%; border:none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Cetak 1 Magang --}}
    @foreach ($sk as $item)
        <div class="modal fade" id="cetakSKMagangModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
                        <iframe src="{{ route('pimpinan.sksiswa.cetakSatu', $item->id) }}"
                            style="width:100%; height:100%; border:none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            let entriesPerPage = parseInt($('#entriesPerPage').val());
            let currentPage = 1;
            let filteredRows = $('.sk-row').toArray();

            // Search filter
            $('#searchInput').on('input', function () {
                let search = $(this).val().toLowerCase();
                filteredRows = [];
                $('.sk-row').each(function () {
                    let match = $(this).data('search').includes(search);
                    $(this).toggle(match); // sementara toggle untuk pencarian langsung
                    if (match) filteredRows.push($(this));
                });
                currentPage = 1;
                displayPage();
            });

            // Change entries per page
            $('#entriesPerPage').on('change', function () {
                entriesPerPage = parseInt($(this).val());
                currentPage = 1;
                displayPage();
            });

            // Prev button
            $('#prevPage').on('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    displayPage();
                }
            });

            // Next button
            $('#nextPage').on('click', function () {
                const totalPages = Math.ceil(filteredRows.length / entriesPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    displayPage();
                }
            });

            // Fungsi tampilkan data
            function displayPage() {
                $('.sk-row').hide();

                const startIndex = (currentPage - 1) * entriesPerPage;
                const endIndex = Math.min(startIndex + entriesPerPage, filteredRows.length);

                for (let i = startIndex; i < endIndex; i++) {
                    const $row = $(filteredRows[i]);
                    $row.show();
                    $row.find('.row-number').text(i + 1);
                }

                updatePaginationInfo();
                updatePaginationButtons();
            }

            // Info "Menampilkan 1 sampai ..."
            function updatePaginationInfo() {
                const totalEntries = filteredRows.length;
                const start = (currentPage - 1) * entriesPerPage + 1;
                const end = Math.min(start + entriesPerPage - 1, totalEntries);

                $('#showingStart').text(totalEntries ? start : 0);
                $('#showingEnd').text(totalEntries ? end : 0);
                $('#totalEntries').text(totalEntries);
            }

            // tombol page number
            function updatePaginationButtons() {
                const totalPages = Math.ceil(filteredRows.length / entriesPerPage);

                // Update prev/next
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
                    html: 'Yakin ingin menghapus data SK Magang?<br><b>Data tidak bisa dikembalikan!</b>',
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

            // Jalankan pertama kali
            displayPage();
        });
    </script>

@endsection
