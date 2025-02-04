<div id="edit-account-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Update Account</h2>
        <form id="update-form" method="POST">
            @csrf
            @method('PUT')
            <div class="user-info">
                <div class="nameInfo1">
                    <span>First Name:</span>
                    <x-text-input id="update-name" class="user-information highlightable" type="text" name="name"
                        placeholder="First name" required autofocus autocomplete="name" />
                    <span class="error"></span>
                </div>
                <div class="nameInfo2">
                    <span>Middle Name:</span>
                    <x-text-input id="update-mname" class="user-information highlightable" type="text" name="mname"
                        placeholder="Middle name" autocomplete="mname" />
                    <span class="error"></span>
                </div>
                <div class="nameInfo3">
                    <span>Last Name:</span>
                    <x-text-input id="update-lname" class="user-information highlightable" type="text" name="lname"
                        placeholder="Last name" required autocomplete="mname" />
                    <span class="error"></span>
                </div>
                <div class="nameInfo">
                    <span>Suffix:</span>
                    <x-text-input id="update-suffix" class="user-information-suff" type="text" name="suffix" />
                    <span class="error"></span>
                </div>
            </div>
            <div class="other-info">
                <span>Email:</span>
                <x-text-input id="update-email" class="other-infos highlightable" type="email" name="email" required
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <span class="error"></span>
            </div>
            <div class="other-info">
                <span>Password:</span>
                <x-text-input id="update-password" class="other-infos highlightable" type="password" name="password"
                    autocomplete="new-password" />
                <div class="error"></div>
            </div>
            <div class="other-info">
                <span>Confirm Password:</span>
                <x-text-input id="password_confirmation" class="other-infos highlightable" type="password"
                    name="password_confirmation" autocomplete="new-password" />
                <span class="error"></span>
            </div>

            <button type="submit" class="update-btn">Update</button>

        </form>
    </div>
</div>
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