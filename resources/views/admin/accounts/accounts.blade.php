<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Barangay 216 E-Portal') }}</title>

    <!-- Fonts -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
    <!-- Scripts -->
    @vite(['resources/css/DashboardStyle.css'])
    @vite(['resources/js/DBscript.js'])
    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    <section id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <div class="logo">
                <img id="imglogo" src="{{ Vite::asset('image/logo.png') }}" alt="Barangay 216 Logo"
                    style="width: 300px; height: 250px; margin-top: 165px; margin-left: 8px;">
            </div>

        </a> <br><br>
        <ul class="side-menu top">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.announcement.announcement') }}">
                    <i class='bx bx-news'></i>
                    <span class="text">Announcement</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.records.records') }}">
                    <i class='bx bxs-file-plus'></i>
                    <span class="text">Records</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.borrowed.borrowed') }}">
                    <i class='bx bxs-book-add'></i>
                    <span class="text">Borrowed</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.blotter.blotter') }}">
                    <i class='bx bx-detail'></i>
                    <span class="text">Blotter</span>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('admin.accounts.accounts') }}">
                    <i class='bx bxs-user-account'></i>
                    <span class="text">Account</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.residentofficials.residentofficials') }}">
                    <i class='bx bxs-user-detail'></i>
                    <span class="text">Residents&officials</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reports.reports') }}">
                    <i class='bx bxs-file icon'></i>
                    <span class="text">Reports</span>
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
                {{ Auth::user()->usertype }}: {{ Auth::user()->name }}
                    <i class='bx bxs-chevron-down cursor-pointer' id="profile-toggles"></i>
                </div>

                <div class="profile-dropdown pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}
                            {{ Auth::user()->mname }} {{ Auth::user()->lname }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('admin.profile.editProfile')"
                            style="border-top: 1px solid #333;">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
                            @csrf
                            <x-responsive-nav-link :href="route('admin.logout')"
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

            @include('admin.accounts.account-content')

        </main>
        <!-- MAIN -->

    </section>
</body>

</html>

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>