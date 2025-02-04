<div id="edit-account-modal-mobile" class="modal">
    <div class="modal-contents">
        <!-- Update Profile Form -->
        <div class="profile-infos1">
            <h3>Update Information
                <br>
                <small>Update your account's profile information and email address.</small>
            </h3>
            <hr>
            <form id="update-profile-form" method="POST" action="{{ route('resident.profile.update') }}">
                @csrf <!-- CSRF Token -->
                @method('PUT') <!-- Specify PUT method if updating -->
                <div class="user-infos">
                    <div class="namesInfo1">
                        <span>First Name:</span>
                        <x-text-input id="update-name" class="user-information" type="text" name="name"
                            placeholder="First name" value="{{ Auth::user()->name }}" required autofocus
                            autocomplete="name" />
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="namesInfo2">
                        <span>Middle Name:</span>
                        <x-text-input id="update-mname" class="user-information" type="text" name="mname"
                            placeholder="Middle name" value="{{ Auth::user()->mname }}" />
                        @error('mname') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="namesInfo3">
                        <span>Last Name:</span>
                        <x-text-input id="update-lname" class="user-information" type="text" name="lname"
                            placeholder="Last name" value="{{ Auth::user()->lname }}" required autocomplete="lname" />
                        @error('lname') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="namesInfo4">
                        <span>Suffix:</span>
                        <x-text-input id="update-suffix" class="user-information-suff" type="text" name="suffix"
                            placeholder="Suffix" value="{{ Auth::user()->suffix }}" />
                        @error('suffix') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="users-info">
                    <span>Email:</span>
                    <x-text-input id="update-email" class="other-infos highlightable" type="email" name="email"
                        placeholder="Email" value="{{ Auth::user()->email }}" autocomplete="username" />
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="users-info">
                    <span>Address:</span>
                    <x-text-input id="update-suffix" class="user-information-suff" type="text" name="address"
                        placeholder="Suffix" value="{{ Auth::user()->address }}" />
                    @error('address') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="users-info">
                    <div class="nameInfos1">
                        <span>Age:</span>
                        <x-text-input id="update-age" class="user-information" type="number" name="age"
                            value="{{ Auth::user()->age }}" autocomplete="age" />
                        @error('age') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="namesInfos2">
                        <span>Gender:</span>
                        <select id="gender" name="gender" class="gender">
                            <option value="{{ Auth::user()->gender }}" disabled selected>
                                {{ Auth::user()->gender }}
                            </option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                        @error('gender') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="namesInfos3">
                        <span>Resident Type:</span>
                        <select id="gender" name="residenttype" class="residenttype">
                            <option value="{{ Auth::user()->residenttype }}" disabled selected>
                                {{ Auth::user()->residenttype }}
                            </option>
                            <option value="Owner">Owner</option>
                            <option value="Tenant">Tenant</option>
                        </select>
                        @error('residenttype') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <button style="float:right;margin-right:10px" type="submit" class="update-btn">Save</button>
            </form>
        </div>

        <!-- Update Password Form -->
        <div class="profile-infos2">

            <h3>Update Password <br>
                <small>Ensure your account is using a long, random password to stay secure.</small>
            </h3>
            <hr>
            <form id="update-password-form" method="POST" action="{{ route('resident.password.updates') }}">
                @csrf <!-- CSRF Token -->
                @method('PUT') <!-- Specify PUT method if updating -->
                <div class="others-info">
                    <span>Current Password:</span>
                    <x-text-input id="update_old_password" class="other-infos highlightable" type="password"
                        name="current_password" autocomplete="current-password" />
                    @error('current_password')
                    <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="others-info">
                    <span>New Password:</span>
                    <x-text-input id="update-password" class="other-infos highlightable" type="password" name="password"
                        autocomplete="new-password" />
                    @error('password')
                    <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="others-info">
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