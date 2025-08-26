<div>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="nav-profile-image">
                        <img src="{{asset('template/dist')}}/assets/images/faces/face1.jpg" alt="profile" />
                        <span class="login-status online"></span>
                        <!--change to offline or busy as needed-->
                    </div>
                    <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold mb-2">{{auth()->user()->name}}</span>
                        <span class="text-secondary text-small">ADMIN</span>
                    </div>
                    <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                </a>
            </li>

            <x-sidebar.links title='Dashboard' icon='mdi mdi-home menu-icon' route='home' />
            <x-sidebar.dropdown id="pegawai-dropdown" title="Pegawai" icon="mdi mdi-account-group" :items="[
                ['label' => 'Data Pegawai', 'url' => route('pegawai.index')],
                ['label' => 'Daftar SK Kerja', 'url' => url('pages/ui-features/dropdowns.html')],
            ]" />
                    <x-sidebar.dropdown id="magang-dropdown" title="Magang" icon="mdi mdi-account-school" :items="[
                ['label' => 'Data Magang', 'url' => url('pages/ui-features/dropdowns.html')],
                ['label' => 'Daftar SK Magang', 'url' => url('pages/ui-features/dropdowns.html')],
                ['label' => 'Nilai Magang', 'url' => url('pages/ui-features/dropdowns.html')],
                ['label' => 'Sertifikat', 'url' => url('pages/ui-features/dropdowns.html')],
            ]" />


            <x-sidebar.links title='Logout' icon='mdi mdi-logout menu-icon text-danger' route='logout' />



        </ul>
    </nav>
</div>
@push('script')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

@endpush
