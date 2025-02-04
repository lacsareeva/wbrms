<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Barangay 216 E-Portal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    @vite(['resources/css/index.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div>
            <div class="logo">
                <img src="{{ Vite::asset('image/logo.png') }}" alt="Barangay 216 Logo">
            </div>
        </div>
        <div class="sub-container">
            <div class="contain">
                <p>
                    Forgot your password? No problem.
                    Just Enter your verified email address and we will send you an OTP verification
                    to reset your password.
                </p>
            </div> <br>

            <!-- Session Status -->
            <form action="{{ route('resident.send-otp') }}" method="POST">
                @csrf

                <!-- Email Address -->
                <div class="lbl">
                    <label style="font-weight:700" for="email">Email</label> <br>
                    <input id="email" class="email-input" type="email" name="email" :value="old('email')" required
                        autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="btn">
                    <button class="send-btn">
                        {{ __('Send OTP') }}
                    </button>
                </div>
            </form>
        </div>

    </div>
    @if (session('otpError'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Slow down!',
                text: '{{ session('otpError') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

</body>

</html>