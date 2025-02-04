<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Barangay 216 E-Portal') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite('resources/css/style.css')
    @vite('resources/js/app.js')
</head>

<body class="font-sans text-gray-900 antialiased">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container">
        <div class="logo">
            <img src="{{ Vite::asset('image/logo.png') }}" alt="Barangay 216 Logo">
        </div>
        <h1>BAGONG BARANGAY 216 E-PORTAL</h1>

        <h3 class="text-center mb-3">Admin Login</h3>
        <div class="login-box">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <!-- Email Address -->

                <div class="form-controls">
                    <x-text-input id="email" type="email" name="email" required autofocus autocomplete="username" />
                    <x-input-label for="email" :value="__('Email')" />

                    @if ($errors->has('email'))
                        <div id="errorModal" class="custom-modal-overlay">
                            <div class="custom-modal-content">
                                <div class="custom-modal-header">
                                    <h5>Error</h5>
                                    <button type="button" class="custom-close-button"
                                        onclick="closeErrorMessageModal()">✕</button>
                                </div>
                                <hr>
                                <div class="custom-modal-body">
                                    @foreach ($errors->get('email') as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                                <hr>

                            </div>
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-controls">

                    <x-text-input id="password" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-label for="password" :value="__('Password')" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>

                <!-- Remember Me -->
                <div class="remember-me">
                    <label for="remember_me">
                        <input id="remember_me" type="checkbox" class="chkbox" name="remember">
                        <span>{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">

                    <x-primary-button class="login-btn">
                        {{ __('Log in') }}
                    </x-primary-button>


                    @if (Route::has('admin.forgot-password'))
                        <a class="forgot-password" href="{{ route('admin.forgot-password') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</body>
@if(session('message'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ e(session('message')) }}",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>