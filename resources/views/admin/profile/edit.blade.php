<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/profile.css'])
    @vite(['resources/js/profile.js']) <!-- Moved to head -->
</head>

<body>
    <section class="content-container">
        <h1>Profile Information</h1>
        <div id="edit-account-modal" class="modal">
            <div class="modal-content">
                <!-- Update Profile Form -->
                <div class="profile-info1">
                    <h3>Update Information
                        <br>
                        <small>Update your account's profile information and email address.</small>
                    </h3>
                    <hr>
                    <form id="update-profile-form" method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf <!-- CSRF Token -->
                        @method('PUT') <!-- Specify PUT method if updating -->
                        <div class="user-info">
                            <div class="nameInfo1">
                                <span>First Name:</span>
                                <x-text-input id="update-name" class="user-information" type="text" name="name"
                                    placeholder="First name" value="{{ Auth::user()->name }}" required autofocus
                                    autocomplete="name" />
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="nameInfo2">
                                <span>Middle Name:</span>
                                <x-text-input id="update-mname" class="user-information" type="text" name="mname"
                                    placeholder="Middle name" value="{{ Auth::user()->mname }}" />
                                @error('mname') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="nameInfo3">
                                <span>Last Name:</span>
                                <x-text-input id="update-lname" class="user-information" type="text" name="lname"
                                    placeholder="Last name" value="{{ Auth::user()->lname }}" required
                                    autocomplete="lname" />
                                @error('lname') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="nameInfo4">
                                <span>Suffix:</span>
                                <x-text-input id="update-suffix" class="user-information-suff" type="text" name="suffix"
                                    placeholder="Suffix" value="{{ Auth::user()->suffix }}" />
                                @error('suffix') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="other-info">
                                <span>Email:</span>
                                <x-text-input id="update-email" class="other-infos highlightable" type="email"
                                    name="email" placeholder="Email" value="{{ Auth::user()->email }}"
                                    autocomplete="username" />
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <button style="float:right;margin-right:10px" type="submit" class="update-btn">Save</button>
                    </form>
                </div>

                <!-- Update Password Form -->
                <div class="profile-info2">
                    <h3>Update Password <br>
                        <small>Ensure your account is using a long, random password to stay secure.</small>
                    </h3>
                    <hr>
                    <form id="update-password-form" method="POST" action="{{ route('admin.password.updates') }}">
                        @csrf <!-- CSRF Token -->
                        @method('PUT') <!-- Specify PUT method if updating -->
                        <div class="other-info">
                            <span>Current Password:</span>
                            <x-text-input id="update_old_password" class="other-infos highlightable" type="password"
                                name="current_password" autocomplete="current-password" />
                            @error('current_password')
                            <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="other-info">
                            <span>New Password:</span>
                            <x-text-input id="update-password" class="other-infos highlightable" type="password"
                                name="password" autocomplete="new-password" />
                            @error('password')
                            <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="other-info">
                            <span>Confirm Password:</span>
                            <x-text-input id="password_confirmation" class="other-infos highlightable" type="password"
                                name="password_confirmation" autocomplete="new-password" />
                            @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <button style="float:right;margin-right:10px" type="submit" class="update-btn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
@if (Session::has('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ e(Session::get('success')) }}",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif

</html>