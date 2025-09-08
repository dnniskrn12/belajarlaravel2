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
                        <h1 class="page-title-modern" style="margin:0;">Dashboard SuperAdmin</h1>
                        <p class="page-subtitle-modern" style="margin:0;">Selamat datang, {{ auth()->user()->name }}!</p>
                    </div>
                </div>
                <div class="header-breadcrumbs">
                    <x-breadcrumbs :items="[['label' => 'Dashboard', 'route' => 'superadmin.dashboard']]" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('template/dist/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Jumlah User <i class="mdi mdi-account mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $jumlahUser }}</h2>
                    <h6 class="card-text">Total user yang terdaftar</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('template/dist/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Jumlah Unit Kerja <i class="mdi mdi-account-group mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $jumlahUnitKerja }}</h2>
                    <h6 class="card-text">Total data unit kerja</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('template/dist/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Jumlah Unit Magang <i class="mdi mdi-school mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $jumlahUnitMagang }}</h2>
                    <h6 class="card-text">Total data unit magang</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('template/dist/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Jumlah Jabatan <i class="mdi mdi-school mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $jumlahJabatan}}</h2>
                    <h6 class="card-text">Total data jabatan</h6>
                </div>
            </div>
        </div>

    </div>

@endsection
