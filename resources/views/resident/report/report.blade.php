<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Barangay 216 E-Portal'))</title>

    <!-- Fonts -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/ResidentStyles/dashboardStyle.css'])
    @vite(['resources/js/ResidentScripts/dashboardScripts.js'])
    @stack('styles')
</head>

<body>
    <!-- Check for session success message -->
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                text: "{{ e(session('success')) }}",
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    popup: 'swal-custom-popup',
                    title: 'swal-custom-title',
                    text: 'swal-custom-text'
                }
            });
        </script>
    @endif

    <!-- Sidebar -->
    <section id="sidebar">
        <a href="{{ route('resident.dashboard') }}" class="brand">
            <div class="logo">
                <img id="imglogo" src="{{ Vite::asset('image/logo.png') }}" alt="Barangay 216 Logo"
                    style="width: 300px; height: 250px; margin-top: 165px; margin-left: 8px;">
            </div>

        </a> <br><br>
        <ul class="side-menu top">
            <li>
                <a href="{{ route('resident.dashboard') }}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('resident.record.record') }}">
                    <i class='bx bxs-file-plus'></i>
                    <span class="text">Request Records</span>
                </a>
            </li>
            <li>
                <a href="{{ route('resident.borrowed.borrowed') }}">
                    <i class='bx bxs-book-add'></i>
                    <span class="text">Borrow Equipment</span>
                </a>
            </li>
            <li>
                <a href="{{ route('resident.blotter.blotter') }}">
                    <i class='bx bx-detail'></i>
                    <span class="text">File Blotter</span>
                </a>
            </li>
            <li>
                <a href="{{ route('resident.brgyOfficials.brgyOfficials') }}">
                    <i class='bx bxs-user-detail'></i>
                    <span class="text">About US</span>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('resident.report.report') }}">
                    <i class='bx bxs-file icon'></i>
                    <span class="text">History</span>
                </a>
            </li>
        </ul>

    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">

        <!-- NAVBAR -->
        <nav class="">

            <div class="navbar flex items-center justify-between p-4 bg-gray-100">

                <i class='bx bx-menu cursor-pointer' id="toggle"></i>
                <div class="navbars flex items-center space-x-2">
                    Resident: {{ Auth::user()->name }}
                    <i class='bx bxs-chevron-down cursor-pointer' id="profile-toggles"></i>
                </div>

                <div class="profile-dropdown pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}
                            {{ Auth::user()->mname }} {{ Auth::user()->lname }} {{ Auth::user()->suffix }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('resident.profile.profile')"
                            style="border-top: 1px solid #333;">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('resident.logout') }}" id="logout-form">
                            @csrf
                            <x-responsive-nav-link :href="route('resident.logout')"
                                onclick="event.preventDefault(); confirmLogout();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        </nav>


        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>

            @include('resident.report.report-content')

        </main>
        <!-- MAIN -->

    </section>
</body>

</html>
@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>