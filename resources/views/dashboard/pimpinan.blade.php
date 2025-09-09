@extends('layouts.purple')

@section('content')
    <div class="container-modern">
        <div class="header-section">
            <div class="header-top" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="header-title" style="display: flex; align-items: center; gap: 12px;">
                    <div class="header-icon bg-gradient-primary">
                        <i class="mdi mdi-home"></i>
                    </div>
                    <div>
                        <h1 class="page-title-modern" style="margin:0;">Dashboard Pimpinan</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Selamat datang, {{ auth()->user()->name }}!</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard']]" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('template/dist/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Jumlah Pegawai <i class="mdi mdi-account-group mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $jumlahPegawai }}</h2>
                    <h6 class="card-text">Total data pegawai</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('template/dist/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Jumlah Magang <i class="mdi mdi-school mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $jumlahMagang }}</h2>
                    <h6 class="card-text">Total siswa magang</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('template/dist/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Jumlah Sertifikat <i class="mdi mdi-certificate mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $jumlahSertifikat }}</h2>
                    <h6 class="card-text">Total sertifikat yang tercatat</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Grafik Data Unit Kerja Per-Cluster</h4>
                    <canvas id="barChartPegawai" style="height:230px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Status Keaktifan Pegawai</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                        <canvas id="pieChartPegawai"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Status Keaktifan Siswa Magang</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                        <canvas id="pieChartMagang"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Grafik Data Unit Magang Per-Cluster</h4>
                    <canvas id="barChartMagang" style="height:230px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Pegawai berdasarkan Jenis Kelamin</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                        <canvas id="doughnutChartPegawai"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Magang berdasarkan Jenis Kelamin</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                        <canvas id="doughnutChartMagang"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        /* biar ukuran chart nggak melar */
        #barChartPegawai {
            max-width: 100% !important;
            height: 300px !important;
        }

        #barChartMagang {
            max-width: 100% !important;
            height: 300px !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Charts initialization started...');

            // Debug data
            console.log('Pegawai cluster data:', @json($labelsPegawaiCluster ?? []), @json($dataPegawaiCluster ?? []));
            console.log('Magang cluster data:', @json($labelsMagangCluster ?? []), @json($dataMagangCluster ?? []));
            console.log('Status Pegawai:', @json($statusPegawai ?? []));
            console.log('Status Magang:', @json($statusMagang ?? []));
            console.log('Gender Pegawai:', @json($genderPegawai ?? []));
            console.log('Gender Magang:', @json($genderMagang ?? []));

            // Chart options for better display
            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            };

            function getPastelColors(count) {
                const baseColors = [
                    'rgba(38, 166, 154, 0.6)',  // toska pastel
                    'rgba(171, 71, 188, 0.6)',  // ungu pastel
                    'rgba(255, 206, 86, 0.6)',   // kuning pastel
                    'rgba(75, 192, 192, 0.6)',   // hijau pastel
                    'rgba(153, 102, 255, 0.6)',  // ungu pastel
                    'rgba(255, 159, 64, 0.6)'    // oranye pastel
                ];
                const colors = [];
                for (let i = 0; i < count; i++) {
                    colors.push(baseColors[i % baseColors.length]);
                }
                return colors;
            }

            // Pegawai per cluster - Bar Chart
            const pegawaiClusterLabels = @json($labelsPegawaiCluster ?? []);
            const pegawaiClusterData = @json($dataPegawaiCluster ?? []);

            if (pegawaiClusterLabels.length > 0) {
                new Chart(document.getElementById("barChartPegawai"), {
                    type: 'bar',
                    data: {
                        labels: pegawaiClusterLabels,
                        datasets: [{
                            label: 'Jumlah Pegawai',
                            data: pegawaiClusterData,
                            backgroundColor: getPastelColors(pegawaiClusterData.length),
                            borderColor: getPastelColors(pegawaiClusterData.length).map(c => c.replace('0.6', '1')),
                            borderWidth: 1
                        }]
                    },


                    options: {
                        ...commonOptions,
                        scales: {
                            y: {
                                beginAtZero: false, // jangan mulai dari 0
                                ticks: {
                                    stepSize: 1,
                                    callback: function (value) {
                                        return value >= 1 ? value : '';
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                console.log('No data for pegawai cluster chart');
            }



            // Magang per cluster - Bar Chart
            const magangClusterLabels = @json($labelsMagangCluster ?? []);
            const magangClusterData = @json($dataMagangCluster ?? []);

            if (magangClusterLabels.length > 0) {
                new Chart(document.getElementById("barChartMagang"), {
                    type: 'bar',
                    data: {
                        labels: magangClusterLabels,
                        datasets: [{
                            label: 'Jumlah Magang',
                            data: magangClusterData,
                            backgroundColor: getPastelColors(magangClusterData.length),
                            borderColor: getPastelColors(magangClusterData.length).map(c => c.replace('0.6', '1')),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        ...commonOptions,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    callback: function (value) {
                                        return value >= 1 ? value : '';
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                console.log('No data for magang cluster chart');
            }


            // Status pegawai - Pie Chart
            const statusPegawaiData = @json($statusPegawai ?? []);
            const statusPegawaiLabels = Object.keys(statusPegawaiData);
            const statusPegawaiValues = Object.values(statusPegawaiData);

            if (statusPegawaiLabels.length > 0) {
                new Chart(document.getElementById("pieChartPegawai"), {
                    type: 'pie',
                    data: {
                        labels: statusPegawaiLabels,
                        datasets: [{
                            data: statusPegawaiValues,
                            backgroundColor: [
                                'rgba(102, 187, 106, 0.6)',  // hijau pastel
                                'rgba(239, 83, 80, 0.6)'   // merah pastel
                            ],
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: commonOptions
                });
            } else {
                console.log('No data for status pegawai chart');
            }

            // Status magang - Pie Chart
            const statusMagangData = @json($statusMagang ?? []);
            const statusMagangLabels = Object.keys(statusMagangData);
            const statusMagangValues = Object.values(statusMagangData);

            if (statusMagangLabels.length > 0) {
                new Chart(document.getElementById("pieChartMagang"), {
                    type: 'pie',
                    data: {
                        labels: statusMagangLabels,
                        datasets: [{
                            data: statusMagangValues,
                            backgroundColor: [
                                'rgba(239, 83, 80, 0.6)',   // merah pastel
                                'rgba(102, 187, 106, 0.6)'  // hijau pastel
                            ],
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: commonOptions
                });
            } else {
                console.log('No data for status magang chart');
            }

            // Gender pegawai - Doughnut Chart
            const genderPegawaiData = @json($genderPegawai ?? []);
            const genderPegawaiLabels = Object.keys(genderPegawaiData);
            const genderPegawaiValues = Object.values(genderPegawaiData);

            if (genderPegawaiLabels.length > 0) {
                new Chart(document.getElementById("doughnutChartPegawai"), {
                    type: 'doughnut',
                    data: {
                        labels: genderPegawaiLabels,
                        datasets: [{
                            data: genderPegawaiValues,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)'
                            ],
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: commonOptions
                });
            } else {
                console.log('No data for gender pegawai chart');
            }

            // Gender magang - Doughnut Chart
            const genderMagangData = @json($genderMagang ?? []);
            const genderMagangLabels = Object.keys(genderMagangData);
            const genderMagangValues = Object.values(genderMagangData);

            if (genderMagangLabels.length > 0) {
                new Chart(document.getElementById("doughnutChartMagang"), {
                    type: 'doughnut',
                    data: {
                        labels: genderMagangLabels,
                        datasets: [{
                            data: genderMagangValues,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 99, 132, 0.6)'
                            ],
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: commonOptions
                });
            } else {
                console.log('No data for gender magang chart');
            }

            console.log('Charts initialization completed.');
        });
    </script>
@endpush
