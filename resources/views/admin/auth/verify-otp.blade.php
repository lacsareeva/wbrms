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
    <!-- Scripts -->
    @vite(['resources/css/index.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ Vite::asset('image/logo.png') }}" alt="Barangay 216 Logo">
        </div>
        <div class="sub-container">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Enter the OTP number that send to your email to process resetting your password.') }}
            </div> <br>

            <form action="{{ route('admin.verify-otp') }}" method="POST">
                @csrf
                <input type="text" class="email-input" name="otp" placeholder="Enter OTP" required>

                <button type="submit" class="otpbtn">Verify OTP</button>
            </form>

        </div>
    </div>
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

    @if($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: '{{ $errors->first('otp') }}',
                confirmButtonText: 'OK',
            });
        </script>
    @endif

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

</body>

</html>