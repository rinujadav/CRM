{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
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
    <title>Reset Password</title>
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
    <link rel="stylesheet" href="{{ asset('dist/css/main.css?' . time()) }}">
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
                        Reset Password
                    </h2>
                    <p class="fw-thin h4 text-white-80 mt-3">You can reset your password from here, please enter the
                        password and
                        enter reset password and press the reset button.
                    </p>
                    <div class="bubble-people-wrapper h-auto">
                        <img class="bubble-item first big" src="{{ asset('images/reset.png') }}"
                            alt="Man with smile">
                    </div>
                </div>
            </div>
            <div class="col right-content">
                <form action="{{ route('password.update') }}" method="post" autocomplete="off"
                    class="card login-form-box">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="logo" class="logo">
                    <h1 class="h2 text-center login-title">Reset Password</h1>
                    <p class="h5 fw-normal text-muted text-center mb-4 pb-3">Please enter your new password and complete
                        the reset
                        password process.</p>
                    {{-- <div class="input-group mb-3">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{old('email',$request->email)}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <div class="text-danger col-md-12" id="email_error" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    </div> --}}
                    <div class="form-group">
                        <div class="input-password-group">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="New password" value="{{old('password')}}">
                            <a class="eye-icon fa fa-eye-slash js-password-hide-show cursor-pointer"></a>
                        </div>
                        @error('password')
                            <span class="error-msg" id="password_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-password-group">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Confirm new password" value="{{old('password_confirmation')}}">
                            <a class="eye-icon fa fa-eye-slash js-password-hide-show cursor-pointer"></a>
                        </div>
                        @error('password_confirmation')
                            <span class="error-msg" id="password_confirmation_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary form-group">Reset password</button>
                    <a href="{{ route('login') }}" class="btn btn-outline-dark btn-block">Cancel</a>
                </form>
            </div>
            <!-- /.col -->
        </div>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script>
        $(".js-password-hide-show").click(function() {
            let $input = $(this).prev('input');
            if ($input.attr('type') == 'text') {
                $(this).removeClass('fa-eye').addClass('fa-eye-slash')
                $input.attr('type', 'password')
            } else {
                $(this).addClass('fa-eye').removeClass('fa-eye-slash')
                $input.attr('type', 'text')
            }
        })
    </script>
</body>

</html>
