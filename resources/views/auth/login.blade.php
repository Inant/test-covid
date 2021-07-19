<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('login-assets/css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('login-assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('login-assets/css/custom.css') }}" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    {{-- favicon --}}
    <link href="{{ asset('login-assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('login-assets/img/logo.png') }}" rel="apple-touch-icon">
</head>

<body class="bg-light">
    <div class="container container-login">
        <div class="row justify-content-center">
            <div class="col-md-10" id="body_form" style="overflow:auto">
                <div class="box-login">
                    <div class="left">
                        <img src="{{ asset('login-assets/img/logo.png') }}" width="40px" alt="">
                        <div class="form mt-3">
                            <form id="FormLogin" method="post" class="" action="{{ route('login') }}">
                                @if ($errors->any())

                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor"
                                                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                                viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                <path
                                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                            <div>
                                                {{ $error }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @csrf
                                @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <i class="fa fa-times-circle"></i> {{session('error')}}
                                </div>
                                @endif

                                <label for="">Email</label>
                                <div class="form-underline">
                                    <input type="email" name="email" placeholder="Masukkan email"
                                        class="" value="{{ old('email') }}"
                                        required autocomplete="email" autofocus>
                                    <span class="fa fa-user"></span>
                                </div>
                                <br>
                                <label for="">Password</label>
                                <div class="form-underline">
                                    <input type="password" name="password"
                                        class="" placeholder="Masukkan Password"
                                        autocomplete="current-password" required>
                                    <span class="fa fa-lock"></span>
                                </div>
                                <br>
                                <div class="form-underline">
                                </div>
                                <br>
                                <button type="sumit" class="btn btn-primary px-5 font-weight-bold ls-1">Login</button>
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="text">
                            <h5>Klinik Dokterku</h5>
                            {{-- <p class="font-weight-light">Jawa Timur</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="copyright mt-4">
        Copyright 2021 - <a href="https://limadigital.id/" target="_blank">LIMA Digital</a>
    </div> --}}
</body>

</html>
