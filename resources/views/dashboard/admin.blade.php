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
                        <h1 class="page-title-modern" style="margin:0;">Dashboard Pak Admin</h1>
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

@endsection
