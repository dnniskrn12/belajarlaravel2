<div>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            @php
                $role = auth()->user()->role->role_name;

                // Tentukan gambar sesuai role
                $profileImage = match ($role) {
                    'admin' => 'admin.png',
                    'superadmin' => 'superadmin.png',
                    'pimpinan' => 'pimpinan.png',
                    default => 'default.png'
                };

                // Tentukan background role sesuai permintaan
                $roleBg = match ($role) {
                    'admin' => 'bg-info text-white',       // biru
                    'superadmin' => 'bg-danger text-white',    // merah
                    'pimpinan' => 'bg-success text-white',     // hijau
                    default => 'bg-secondary text-white'       // abu-abu
                };
            @endphp

            <li class="nav-item nav-profile">
                <a href="#" class="nav-link d-flex align-items-center">
                    <div class="nav-profile-image position-relative">
                        <img src="{{ asset('template/dist/assets/images/faces/' . $profileImage) }}" alt="profile"
                            class="rounded-circle" />
                        <span
                            class="availability-status online position-absolute bottom-0 end-0 border border-white rounded-circle"></span>
                    </div>
                    <div class="nav-profile-text ms-3">
                        <span class="font-weight-bold mb-1 d-block">{{ auth()->user()->name }}</span>
                        <span class="text-small text-uppercase px-2 py-1 rounded {{ $roleBg }}"
                            style="margin-top:4px; display:inline-block;">
                            {{ $role }}
                        </span>
                    </div>
                    <i class="mdi mdi-bookmark-check text-warning nav-profile-badge"></i>
                </a>
            </li>




            {{-- Menu untuk Admin --}}
            @if(auth()->user()->role->role_name === 'admin')
                    <x-sidebar.links title='Dashboard' icon='mdi mdi-home menu-icon' route='admin.dashboard' />
                    <x-sidebar.dropdown id="pegawai-dropdown" title="Pegawai" icon="mdi mdi-account-group" :items="[
                    ['label' => 'Data Pegawai', 'url' => route('admin.pegawai.index')],
                    ['label' => 'Daftar SK Kerja', 'url' => route('admin.skkerja.index')],
                ]" />
                    <x-sidebar.dropdown id="magang-dropdown" title="Magang" icon="mdi mdi-account-school" :items="[
                    ['label' => 'Data Magang', 'url' => route('admin.magang.index')],
                    ['label' => 'Daftar SK Magang', 'url' => route('admin.sksiswa.index')],
                    ['label' => 'Nilai Magang', 'url' => route('admin.nilaipkl.index')],
                    ['label' => 'Sertifikat', 'url' => route('admin.sertifikat.index')],
                ]" />
            @endif

            {{-- Menu untuk SuperAdmin --}}
            @if(auth()->user()->role->role_name === 'superadmin')
                    <x-sidebar.links title='Dashboard' icon='mdi mdi-home menu-icon' route='superadmin.dashboard' />
                    <x-sidebar.links title='Data User' icon='mdi mdi-account-key menu-icon' route='superadmin.user.index' />
                    <x-sidebar.dropdown id="datamaster-dropdown" title="Data Master" icon="mdi mdi-folder-lock" :items="[
                    ['label' => 'Jabatan', 'url' => route('superadmin.jabatan.index')],
                    ['label' => 'Unit Kerja', 'url' => route('superadmin.unitkerja.index')],
                    ['label' => 'Unit Magang', 'url' => route('superadmin.unitmagang.index')],
                    ['label' => 'Lokasi', 'url' => route('superadmin.lokasi.index')],
                ]" />
            @endif


            {{-- Menu untuk Pimpinan --}}
            @if(auth()->user()->role->role_name === 'pimpinan')
                    <x-sidebar.links title='Dashboard' icon='mdi mdi-home menu-icon' route='pimpinan.dashboard' />
                    <x-sidebar.dropdown id="laporan-dropdown" title="Laporan" icon="mdi mdi-folder-file-outline" :items="[
                    ['label' => 'Data Pegawai', 'url' => route('pimpinan.pegawai.index')],
                    ['label' => 'SK Kerja', 'url' => route('pimpinan.skkerja.index')],
                    ['label' => 'Data Magang', 'url' => route('pimpinan.magang.index')],
                    ['label' => 'SK Magang', 'url' => route('pimpinan.sksiswa.index')],
                    ['label' => 'Sertifikat', 'url' => route('pimpinan.sertifikat.index')],
                ]" />
            @endif

            {{-- Logout --}}
            <x-sidebar.links title='Logout' icon='mdi mdi-logout menu-icon text-danger' route='logout' />

        </ul>
    </nav>
</div>
