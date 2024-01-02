<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-login/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template-login/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-login/css/main.css') }}">
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="container-login100 bg-white">
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">

                <form action="/pasien/login" method="POST" class="login100-form validate-form flex-sb flex-w">
                    @csrf

                    <span class="login100-form-title p-b-32">
                        <a href="/">
                            <h2><b>Poli</b>klinik</h2>
                        </a>
                    </span>
                    <span class="login100-form-title p-b-32">Akun Pasien</span>
                    @if (session('loginError'))
                        <div class="alert alert-danger">
                            {{ session('loginError') }}
                        </div>
                    @endif
                    <div class="wrap-input100 validate-input m-b-36" data-validate = "No_ktp is required">
                        <input type="text" name="no_ktp" class="input100" id="no_ktp" placeholder="No ktp"
                            value="{{ old('no_ktp') }}" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div>
                        <button type="submit" class="login100-form-btn" style="margin-left: 150px;">Masuk</button>
                    </div>
                </form>

                <div style="margin-top: 40px;">
                    <p>Belum punya akun? <a href="{{ route('pasien.register') }}"><b>Daftar</b></a></p>
                </div>
            </div>
        </div>
    </div>

    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('template-login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('template-login/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('template-login/js/main.js') }}"></script>

</body>

</html>
