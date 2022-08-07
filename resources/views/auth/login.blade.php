<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Title --> 
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <title>{{ env('APP_NAME') }} | Form Login</title>

    <!-- Icon -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> 

    <!-- CSS -->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body class="bg-light">
    <div class="top-bar-login row m-5">
        <div class="col-md-6 text-left">
            <p class="text-primary font-weight-bolder fs-20">Visit Data Center</p>
        </div>
        <div class="col-md-6 text-right">
            <img src="{{ asset('images/logo.png') }}" width="150" alt="Logo">
        </div>
    </div>
    <div class="col-md-4 container mt-10-m">
        <div class="text-center mb-4">
            <p class="font-weight-bolder fs-30 text-black">Sign In</p>
            <p class="font-weight-bolder text-gray-500 fs-18">Enter your username and password</p>
        </div>
        <div class="card shadow" style="border: none; border-radius: 20px">
            <div class="card-body p-5">
                <form method="POST" class="mt-4 needs-validation" novalidate action="{{ route('login') }}">
                    @csrf
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-envelope text-black"></i></div>
                            </div>
                            <input type="email" class="form-control form-control-lg fs-14 @error('email') rounded-right is-invalid @enderror" id="email" name="email" placeholder="Email" required autofocus>
                            @error('email')
                                <span class="invalid-feedback mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-auto mt-4">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-key text-black"></i></div>
                            </div>
                            <input type="password" class="form-control form-control-lg  fs-14 @error('password') rounded-right is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="off">
                            @error('password')
                                <span class="invalid-feedback mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-auto mt-4">
                        <div class="form-check mb-2 mr-sm-2">
                            <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                            <label class="form-check-label fs-14 ml-1 text-gray-800 font-weight-bold" for="inlineFormCheck">
                              Remember my password
                            </label>
                        </div>
                    </div>
                    <div class="col-auto mt-4">
                        <button class="btn btn-primary btn-block font-weight-bold">Login</button>
                    </div>
                    <div class="text-center mt-5">
                        <p class="font-weight-bolder fs-18 text-gray-500">PT Jedi Global Teknologi</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
    <!-- Script -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
</html>