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
    @vite(['resources/css/ResidentStyles/registerStyle.css', 'resources/js/ResidentScripts/residentScripts.js'])
</head>

<body>
    <div class="container">
        <div class="headers">
            <h2 class="text-center mb-3">Register new account</h2>
        </div>

        <form method="POST" action="{{ route('resident.register') }}" id="register-form" enctype="multipart/form-data">
            @csrf
            <div class="container1">
                <hr>
                <div class="sub-header">
                    <h4>User Information</h4>
                </div>
                <hr>
                <!-- Name -->
                <div class="user-info">
                    <div class="nameInfo1">
                        <input id="name" class="user-information highlightable" type="text" name="name"
                            placeholder="First name" required autofocus autocomplete="name" />
                        <span class="error"></span>
                    </div>
                    <div class="nameInfos2">
                        <input id="mname" class="user-information highlightable" type="text" name="mname"
                            placeholder="Middle name" autocomplete="mname" />
                        <span class="error"></span>
                    </div>
                    <div class="nameInfos3">
                        <input id="lname" class="user-information highlightable" type="text" name="lname"
                            placeholder="Last name" required autocomplete="mname" />
                        <span class="error"></span>
                    </div>
                    <div class="nameInfos">
                        <input id="suffix" class="user-information-suff" type="text" name="suffix"
                            placeholder="Suffix" />
                        <span class="error"></span>
                    </div>
                </div>

                <div class="other-info">

                    <div class="othersInfo1">
                        <input id="address" class="other-infos highlightable" type="text" name="address"
                            placeholder="Address" />
                        <div class="error"></div>
                    </div>

                    <div class="othersInfo2">
                        <input id="email" class="other-infos highlightable" type="email" name="email"
                            placeholder="Email" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" />
                    </div>

                    <div class="othersInfo3">
                        <input id="password" class="other-infos highlightable" type="password" name="password"
                            placeholder="Password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <div class="error"></div>
                    </div>

                    <div class="othersInfo4">
                        <input id="password_confirmation" class="other-infos highlightable" type="password"
                            placeholder="Confirm Password" name="password_confirmation" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        <span class="error"></span>
                    </div>
                </div>

                <div class="other-info">
                    <div class="gender1">
                        <select id="gender" name="gender" class="gender highlightable" required>
                            <option value="" disabled selected> select gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                        <div class="error"></div>
                    </div>

                    <div class="gender2">
                        <input id="age" class="gender highlightable" type="number" placeholder="Enter age" name="age"
                            required autocomplete="age" />
                        <error :messages="$errors->get('age')" class="mt-2" />
                        <div class="error"></div>
                    </div>

                    <div class="gender3">
                        <select id="gender" name="residenttype" class="gender highlightable" required>
                            <option value="" disabled selected>select resident type</option>
                            <option value="Renter">Tenant</option>
                            <option value="Owner">Owner</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>

                <div class="other-info" style="display:none;">
                    <input id="usertype" class="other-infos highlightable" type="text" name="usertype" value="resident"
                        required />
                    <x-input-error :messages="$errors->get('usertype')" class="mt-2" />
                    <div class="error"></div>
                </div>
                <br>
                <br>
            </div>

            <div class="container2">
                <hr>
                <!-- Verification -->
                <div class="sub-header">
                    <h4>Verification</h4>
                </div>
                <hr>
                <!-- Verification ID-->
                <div class="container2Content">
                    <div class="Verification-ID">
                        <select style="border: 1px solid #3b3a3a;" id="verification_id" name="verification_id" class="id-info highlightable" onchange="toggleInput(this)" required>
                            <option value="" disabled selected>Type of ID</option>
                            <option value="Barangay ID">Barangay ID</option>
                            <option value="TIN ID">TIN ID</option>
                            <option value="UMID ID">UMID ID</option>
                            <option value="UMID ID">VOTERS ID</option>
                            <option value="UMID ID">PHILHEALTH ID</option>
                            <option value="UMID ID">BARANGAY ID</option>
                            <option value="UMID ID">PHILIPPINE ID</option>
                            <option value="Other ID">OTHER VALID ID</option>
                        </select>
                        <input type="text" id="customInput" class="custominput" name="verification_id" style="display:none;" placeholder="Enter other valid ID">

                        <span class="errors"></span>
                    </div>

                    <div class="Verification-ID-number">
                        <input id="id_number" style="border: 1px solid #3b3a3a;" class="id_numberss highlightable" type="number" placeholder="Id-Number"
                            name="verification_id_number" autocomplete="verification_id_number" required />
                        <x-input-error :messages="$errors->get('verification_id_number')" class="mt-2" />
                        <span class="errors"></span>
                    </div>
                </div>

                <!-- Verification ID Image-->
                <div class="imageContents">
                    
                    <div id="ImageDetailsContainer" style="margin-top:40px">
                        <div class="card-body media align-items-center">
                            <img id="profilePictures" src="{{ Vite::asset('image/default-image.png') }}" alt="id Photo"
                                class="highlightable" />
                            <div>
                                <div class="btn-data">
                                    <label class="btn btn-outline-primary">
                                        <span class="btn_label">Upload ID Photo</span>
                                        <input id="verification_id_image" type="file" class="account-settings-fileinput"
                                            name="verification_id_image" onchange="previewImage(event)" accept="image/*"
                                            required />
                                    </label>
                                    <button class="buttonss" type="button" id="resetbtn" onclick="resetImage()">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <span class="errors"></span>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="certify-container">
                    <div class="certify-information">
                        <input id="certify-info" type="checkbox" class="chkbox" name="remember" required>
                        <span>I Certify that all information on this form are true and correct. I understand
                            that
                            any incorrect, false or misleading statement is punishable by law.</span>
                    </div>
                </div>

                <div class="link-btn">
                    <a class="register-link" href="{{ route('resident.login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="register-btn" id="register-id">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
<script>
    var defaultImageUrl = "{{ Vite::asset('image/default-image.png') }}";
</script>