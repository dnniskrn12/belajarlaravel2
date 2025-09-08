<div>
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <a class="navbar-brand brand-logo" href="index.html">
                <img src="{{asset('template/dist')}}/assets/images/image.svg" alt="logo"
                    style="height:75px; width:auto;">
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
                <img src="{{asset('template/dist')}}/assets/images/image-mini.svg" alt="logo"
                    style="height:65px; width:auto;">
            </a>

        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <div class="search-field d-none d-md-block">
                <form class="d-flex align-items-center h-100" action="#">
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                            <i class="input-group-text border-0 mdi mdi-magnify"></i>
                        </div>
                        <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                    </div>
                </form>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" id="profileDropdown" href="#"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        <!-- Profile Image -->
                        <div class="nav-profile-img position-relative d-flex align-items-center justify-content-center">
                            @php
                                $role = auth()->user()->role->role_name;
                                $profileImage = match ($role) {
                                    'admin' => 'admin.png',
                                    'superadmin' => 'superadmin.png',
                                    'pimpinan' => 'pimpinan.png',
                                    default => 'default.png'
                                };
                            @endphp
                            <img src="{{ asset('template/dist/assets/images/faces/' . $profileImage) }}" alt="image"
                                class="rounded-circle" style="width:45px; height:45px; object-fit:cover;">
                        </div>

                        <!-- Nama -->
                        <div class="nav-profile-text ms-3 d-flex flex-column justify-content-center">
                            <p class="mb-0 fw-bold text-black">{{ auth()->user()->name }}</p>
                        </div>
                    </a>

                    <!-- Dropdown -->
                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="mdi mdi-account-circle me-2 text-success"></i> Profil User
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout me-2 text-danger"></i> Signout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>


                <li class="nav-item d-none d-lg-block full-screen-link">
                    <a class="nav-link">
                        <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                    </a>
                </li>

            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
</div>
