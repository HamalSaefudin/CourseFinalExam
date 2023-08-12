<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/sb-admin-2.min.css') }}">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            @include('layouts.partials.alert')

                            <form action="{{ route('register.action') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-group position-relative  mb-4">
                                    <input type="text" name="nama" id="nama" class="form-control form-control-xl @error('nama') is-invalid @enderror" placeholder="Nama" value="{{ old('nama') }}">
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row align-items-center">
                                    <div class="form-group mb-4">
                                        <input type="email" name="email" id="email" class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">

                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group position-relative  mb-4">
                                    <input type="password" name="password" id="password" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password">

                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group position-relative  mb-4">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-xl @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password">

                                    @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for="silver" style="margin-top: 2px;">Membership </label>
                                <div style="border:1px solid #D1D3E1;padding:10px;border-radius:10px;margin-bottom:5px">
                                    <div class="form-group position-relative  mb-4 ms-3">
                                        <input class="form-check-input" type="radio" name="membership" id="m2" value="silver" checked>
                                        <label for="silver" style="margin-top: 2px;margin-left:10px">Silver </label>
                                    </div>
                                    <div class="form-group position-relative  mb-4 ms-3">
                                        <input class="form-check-input" type="radio" name="membership" id="m1" value="gold">
                                        <label for="gold" style="margin-top: 2px;margin-left:10px">Gold </label>
                                    </div>

                                    <div class="form-group position-relative  mb-4 ms-3">
                                        <input class="form-check-input" type="radio" name="membership" id="m3" value="platinum">
                                        <label for="platinum" style="margin-top: 2px;margin-left:10px">Platinum </label>
                                    </div>
                                </div>
                                <div class="form-group ms-3 d-flex align-items-baseline">
                                    <input class="form-check-input mb-2" type="checkbox" name="isAdmin" id="isAdmin" value="Y">
                                    <label class="form-check-label mb-0" style="margin-left: 10px;margin-top:2px" for="isAdmin">isAdmin</label>
                                </div>
                                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Buat Akun</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>