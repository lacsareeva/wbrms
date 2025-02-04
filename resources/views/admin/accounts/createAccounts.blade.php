<div id="add-account-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddModal()">&times;</span>
        <h2 style="padding-left:40px">Register Account</h2>
        <form id="create_form" method="POST" action="{{route('admin.accounts.save') }}" enctype="multipart/form-data">
            @csrf
            <div class="user-info">
                <div class="nameInfo1">
                    <span>First Name:</span>
                    <x-text-input id="create_name" class="user-information highlightable" type="text" name="name"
                        placeholder="First name" required autofocus autocomplete="name" />
                    <span class="error"></span>
                </div>
                <div class="nameInfo2">
                    <span>Middle Name:</span>
                    <x-text-input id="create_mname" class="user-information highlightable" type="text" name="mname"
                        placeholder="Middle name" autocomplete="mname" />
                    <span class="error"></span>
                </div>
                <div class="nameInfo3">
                    <span>Last Name:</span>
                    <x-text-input id="create_lname" class="user-information highlightable" type="text" name="lname"
                        placeholder="Last name" autocomplete="mname" />
                    <span class="error"></span>
                </div>
                <div class="nameInfo">
                    <span>Suffix:</span>
                    <x-text-input id="create_suffix" placeholder="Suffix" type="text" name="suffix" />
                    <span class="error"></span>
                </div>
            </div>
            <div class="other-info">
                <span>Email:</span>
                <x-text-input id="create_email" class="other-infos highlightable" type="email" name="email" required
                    autocomplete="username" placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <span class="error"></span>
            </div>

            <!-- Password -->
            <div class="other-info">
                <span>Password:</span>
                <x-text-input id="create_password" type="password" name="password" placeholder="Password"
                    autocomplete="new-password" />
                <div class="error"></div>
            </div>

            <!-- Confirm Password -->
            <div class="other-info">
                <span>Confirm Password:</span>
                <x-text-input id="create_password_confirmation" class="other-infos highlightable" type="password"
                    name="password_confirmation" placeholder="confirm password" autocomplete="new-password" />
                <span class="error"></span>
            </div>
            <x-text-input id="usertype" type="text" name="usertype" value="Staff" hidden />

            <button type="submit" class="update-btn">Register</button>

        </form>
    </div>
</div>