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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/index.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ Vite::asset('image/logo.png') }}" alt="Barangay 216 Logo">
        </div>
        <div class="sub-container">
            <h4 style="font-size:17px">Email verified. <br> Create new password</h4>
            <br>

            <form method="POST" action="{{ route('admin.reset-password') }}">
                @csrf

                <!-- Email Address -->
                <input type="hidden" name="email" value="{{ $email }}"> <!-- Email passed from route -->


                <!-- Password -->
                <div class="lbl">
                    <x-input-label style="font-weight:700" for="password" :value="__('Password')" /><br>
                    <x-text-input id="password" class="email-input" type="password" name="password" required
                        placeholder="Enter new password" autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label style="font-weight:700" for="password_confirmation" :value="__('Confirm Password')" />
                    <br>
                    <x-text-input id="password_confirmation" class="email-input" type="password"
                        placeholder="Confirm password" name="password_confirmation" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-right justify-end mt-4">
                    <x-primary-button class="resetbtn">
                        {{ __('Reset Password') }}
                    </x-primary-button>
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

@if (session('otpError'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Validation Error!',
            text: '{{ session('otpError') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

</html>