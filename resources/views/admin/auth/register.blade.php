<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Barangay 216 E-Portal') }}</title>

    <!-- Fonts -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/registerStyle.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div>
            <h2 class="text-center mb-3">Register new account</h2>
        </div>
        <div id="AllContain">
            <form method="POST" action="{{ route('admin.register') }}" id="register-form" enctype="multipart/form-data">
                @csrf
                <div class="contain1" id="container1">
                    <hr>
                    <div class="sub-header">
                        <h4>User Information</h4>
                    </div>
                    <hr>
                    <!-- Name -->
                    <div class="user-info">
                        <div class="nameInfo1">
                            <x-text-input id="name" class="user-information highlightable" type="text" name="name"
                                placeholder="First name" required autofocus autocomplete="name"/>
                            <span class="error"></span>
                        </div>
                        <div class="nameInfo2">
                            <x-text-input id="mname" class="user-information highlightable" type="text" name="mname"
                                placeholder="Middle name" required autocomplete="mname"/>
                            <span class="error"></span>
                        </div>
                        <div class="nameInfo3">
                            <x-text-input id="lname" class="user-information highlightable" type="text" name="lname"
                                placeholder="Last name" required autocomplete="mname"/>
                            <span class="error"></span>
                        </div>
                        <div class="nameInfo">
                            <x-text-input id="suffix" class="user-information-suff" type="text" name="suffix"
                                placeholder="Suffix" />
                            <span class="error"></span>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="other-info">
                        <x-text-input id="email" class="other-infos highlightable" type="email" name="email"
                            placeholder="Email" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <span class="error"></span>
                    </div>

                    <!-- Password -->
                    <div class="other-info">
                        <x-text-input id="password" class="other-infos highlightable" type="password" name="password"
                            placeholder="Password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <div class="error"></div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="other-info">
                        <x-text-input id="password_confirmation" class="other-infos highlightable" type="password"
                            placeholder="Confirm Password" name="password_confirmation" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        <span class="error"></span>
                    </div>

                    <!-- Birth Date -->
                    <label for="Birth Date" class="lbl-btn" >Birth Date</label><br>
                    <div class="birthday-info">
                        <div class="birthInfo1">
                            <select id="month" name="month" class="birthdate highlightable" required>
                                <option value="" disabled selected>Month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <span class="error"></span>
                        </div>
                        <div class="birthInfo2">
                            <select id="day" name="day" class="birthdate highlightable" required>
                                <option value="" disabled selected>Day</option>
                            </select>
                            <span class="error"></span>
                        </div>
                        <div class="birthInfo3">
                            <select id="year" name="year" class="birthdate highlightable" required>
                                <option value="" disabled selected>Year</option>
                                <option value="1990">1990</option>
                                <option value="1991">1991</option>
                                <option value="1992">1992</option>
                                <option value="1993">1993</option>
                                <option value="1994">1994</option>
                                <option value="1995">1995</option>
                                <option value="1996">1996</option>
                                <option value="1997">1997</option>
                                <option value="1998">1998</option>
                                <option value="1999">1999</option>
                                <option value="2000">2000</option>
                            </select>
                            <span class="error"></span>
                        </div>
                    </div>
                    <!-- Gender -->
                    <label for="Genders">Gender</label><br>
                    <div class="gen">
                        <select id="gender" name="gender" class="gender highlightable" required>
                            <option value="" disabled selected>gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="other-info">
                        <x-text-input id="usertype" class="other-infos highlightable" type="text" name="usertype" value="staff"/>
                        <x-input-error :messages="$errors->get('usertype')" class="mt-2" />
                        <div class="error"></div>
                    </div>
                    <button id="nxt_btn">Next</button>

                </div>

                <div class="contain2" id="container2" style="display:none;">
                    <hr>
                    <!-- Verification -->
                    <div class="sub-header">
                        <h4>Verification</h4>
                    </div>

                    <hr>
                    <!-- Verification ID-->
                    <div class="Verification-ID">
                        <select id="verification_id" name="verification_id" class="id-info highlightable">
                            <option value="" disabled selected>Type of ID</option>
                            <option value="Barangay ID">Barangay ID</option>
                            <option value="TIN ID">TIN ID</option>
                            <option value="UMID ID"></option>

                        </select>

                        <span class="errors"></span>
                    </div>

                    <!-- Verification ID Number-->
                    <div class="other-info">
                        <input id="id_number" class="other-infos highlightable" type="text"
                            placeholder="Id-Number" name="verification_id_number" autocomplete="verification_id_number" />
                            <x-input-error :messages="$errors->get('verification_id_number')" class="mt-2" />
                            <span class="errors"></span>
                    </div>

                    <!-- Verification ID Image-->

                    <div id="ImageDetailsContainer">
                        <div class="card-body media align-items-center">
                            <img id="profilePictures" src="{{ Vite::asset('image/default-image.png') }}" alt="id Photo"
                                class="highlightable" />
                            <div>
                                <div class="btn-data">
                                    <label class="btn btn-outline-primary">
                                        <span class="btn_label">Upload ID Photo</span>
                                        <x-text-input id="verification_id_image" type="file" class="account-settings-fileinput"
                                            name="verification_id_image" onchange="previewImage(event)"
                                            accept="image/*"/>
                                    </label>
                                    <button type="button" id="resetbtn" onclick="resetImage()">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>  
                                <span class="errors"></span>    
                            
                            </div>
                        </div>
                    </div>

                    <div class="certify-container">
                        <div class="certify-information">
                            <input id="certify-info" type="checkbox" class="chkbox" name="remember" required>
                            <span>I Certify that all information on this form are true and correct. I understand that
                                any incorrect, false or misleading statement is punishable by law.</span>
                        </div>
                    </div>

                    <div class="link-btn">
                        <a class="register-link" href="{{ route('admin.login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="register-btn" id="register-id">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                    <button id="back_btn">
                        <i class="fas fa-arrow-alt-circle-left"></i>
                    </button>
            </form>
        </div>
    </div>
</body>

</html>
<script>
    var defaultImageUrl = "{{ Vite::asset('image/default-image.png') }}";
</script>