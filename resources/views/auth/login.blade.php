<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('template/dist')}}/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{asset('template/dist')}}/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('template/dist')}}/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{asset('template/dist')}}/assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('template/dist')}}/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('template/dist')}}/assets/images/favicon.png" />
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo" style="display: flex; justify-content: center; align-items: center;">
                                <img src="{{ asset('template/dist/assets/images/image.svg') }}" style="height:130px; width:auto;">
                            </div>
                            <h4>Login ke akun anda</h4>
                            <h6 class="font-weight-light">Silakan masuk menggunakan akun yang sudah terdaftar</h6>

                            <form method="POST" action="{{ route('login') }}" class="pt-3">
                                @csrf
                                <!-- Username -->
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-lg @error('username') is-invalid @enderror"
                                        id="exampleInputUsername1" placeholder="Username" value="{{ old('username') }}" required autofocus>
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        id="exampleInputPassword1" placeholder="Password" required>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Tombol Login -->
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                        LOG IN
                                    </button>
                                </div>

                                <!-- Opsional -->
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input"> Keep me signed in
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-primary">Forgot password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- plugins:js -->
    <script src="{{asset('template/dist')}}/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="{{asset('template/dist')}}/assets/js/off-canvas.js"></script>
    <script src="{{asset('template/dist')}}/assets/js/misc.js"></script>
    <script src="{{asset('template/dist')}}/assets/js/settings.js"></script>
    <script src="{{asset('template/dist')}}/assets/js/todolist.js"></script>
    <script src="{{asset('template/dist')}}/assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
</body>

</html>
