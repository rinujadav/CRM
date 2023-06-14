{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.png')}}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Sweetalert Css -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- Main Customize CSS -->
    <link rel="stylesheet" href="{{ asset('dist/css/main.css?'.time()) }}">
</head>

<body>
    <div class="login-wrapper container-fluid">
        <div class="row login-wrapper-row">
            <div class="col left-content text-center text-white">
                <div class="left-content-inner">
                    <div class="logo-warpper">
                        <img src="{{ asset('images/logo_white.svg') }}" alt="prime payments logo" class="logo">
                    </div>
                    <h2 class="h1">
                        <span class="d-block h3 fw-normal">Hello User,</span>
                        Forgot Password?
                    </h2>
                    <p class="fw-thin h4 text-white-80 mt-3">Don't worry, we're here to help you to get reset your
                        password, just
                        follow the instruction, and get it done.
                    </p>
                    <div class="bubble-people-wrapper h-auto">
                        <img class="bubble-item first big" src="{{ asset('images/forgot.png') }}"
                            alt="Man with smile">
                    </div>
                </div>
            </div>
            <div class="col right-content">
                <form action="{{ route('password.email') }}" method="post" class="card login-form-box">
                    @csrf
                    <img src="{{ asset('images/logo.svg') }}" alt="logo" class="logo">
                    <h1 class="h2 text-center login-title">Forgot Password?</h1>
                    <p class="h5 fw-normal text-muted text-center mb-4 pb-3">No worries! Please enter your registered
                        email
                        address and we will send you the link to reset your password.</p>
                    <div class="form-group">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email address"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="error-msg" id="email_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    <a href="{{ route('login') }}" class="btn btn-light rounded-pill mx-auto mt-5 px-5"><i
                            class="fa fa-arrow-left-long me-2"></i> Back to
                        <strong>Sign In</strong></a>
                    <!-- /.col -->
                </form>



            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    @if (session('status'))
        <script>
            var msg = "{{ session('status') }}";
            Swal.fire(
                msg,
                '',
                'success'
            )
        </script>
    @endif
</body>

</html>
