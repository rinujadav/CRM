{{--
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
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
    <title>Login</title>
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

                    <h2 class="h1">
                        <span class="d-block h3 fw-normal">Welcome to the admin panel !</span>
                    </h2>
                    <p class="fw-thin h4 text-white-80 mt-3"> Manage Comapny and Employees</p>
                    </p>
                    <div class="bubble-people-wrapper">
                        <img class="bubble-item first" src="{{ asset('images/people-3.png') }}" alt="Man with smile">
                        <img class="bubble-item second" src="{{ asset('images/people-1.png') }}" alt="Girl with smile">
                        <img class="bubble-item third" src="{{ asset('images/people-4.png') }}" alt="Man with smile">
                        <img class="bubble-item fourth" src="{{ asset('images/people-2.png') }}" alt="Girl with smile">
                    </div>
                </div>
            </div>
            <div class="col right-content flex-column">
                <form method="POST" action="{{ route('login') }}" autocomplete="off" class="card login-form-box">
                    @csrf

                    <h1 class="h2 text-center login-title">Sign In</h1>
                    <p class="h5 fw-normal text-muted text-center mb-4 pb-3">Please enter your email address and
                        password to get
                        Sign
                        In
                        and you will get the access of your account.</p>



                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email address" id="email" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="error-msg" id="email_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password"
                                id="password">
                            @error('password')
                                <span class="error-msg" id="password_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex form-group justify-content-between">
                            <label class="form-check cursor-pointer">

                                <input type="checkbox" id="remember_me" name="remember" class="form-check-input">
                                <span class="form-check-label" for="remember_me">
                                    Remember me
                                </span>
                            </label>

                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </form>

                </div>

            </div>

        </div>

    </div>


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
