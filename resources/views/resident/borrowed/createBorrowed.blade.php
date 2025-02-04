<div id="walk-in-request-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeWalkInRequestModal()">&times;</span>
        <h2>Borrowed Equipment</h2>
        <form method="POST" action="{{ route('resident.borrowed.save') }}" enctype="multipart/form-data"
            onsubmit="return validateContact()">
            @csrf
            <div class="form-section">
                <div class="form-section1">
                    <label for="first-name">Fullname:</label><br>
                    <input type="text" id="Fullname" name="name"
                        value="{{ Auth::user()->name }} {{ Auth::user()->mname }} {{ Auth::user()->lname }} {{ Auth::user()->suffix }}"
                        readonly>

                </div>
                <div class="form-section2">
                    <label for="address">Address:</label><br>
                    <input type="text" id="create_address" name="address" required autofocus>
                </div>
            </div>
            <div class="form-section">
                <div class="form-section1">
                    <label for="equipment">Equipment / Materials</label><br>
                    <select id="equipment" name="equipment" onchange="toggleInput(this)" required>
                        <option value="">Select Equipment</option>
                        <option value="Chair">Chair</option>
                        <option value="Tent">Tent</option>
                        <option value="Ladder">Ladder</option>
                        <option value="other">Other</option>
                    </select>
                    <input type="text" id="customInput" name="equipment" style="display:none;"
                        placeholder="Enter custom value">
                </div>
                <div class="form-section2">
                    <label for="quantity">Qty.</label><br>
                    <input type="number" id="create_quantity" name="quantity" required>
                </div>
            </div>
            <div class="form-section">
                <div class="form-section1">
                    <label for="purpose">Purpose</label><br>
                    <input type="text" id="create_purpose" name="purpose" required>
                </div>
                <div class="form-section2">
                    <label for="contact">Contact No.</label><br>
                    <input type="number" id="create_contact" name="contact" required>
                </div>
            </div>
            <div class="form-section">
                <div class="form-section1">
                    <label for="borrow-date">Date and Time of Borrowing</label><br>
                    <input type="datetime-local" id="create_borrow_date" name="borrow-date" required>
                </div>
                <div class="form-section2">
                    <label for="return-date">Date and Time of Return</label><br>
                    <input type="datetime-local" id="create_return_date" name="return-date" required>
                </div>
            </div>
            <div class="form-section">
                <input type="hidden" id="create_sender" name="sender" value="{{ Auth::user()->email }}">
                <input type="hidden" id="create_response" name="response">
            </div>

            <div class="form-section">
                <button type="submit" class="proceed-btn">PROCEED</button>
            </div>
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
            showConfirmButton: false,
            customClass: {
                popup: 'swal-custom-popup',
                icon: 'swal-custom-icon',
                title: 'swal-custom-title',
                text: 'swal-custom-text',
                confirmButton: 'swal-custom-confirm',
                cancelButton: 'swal-custom-cancel'
            }
        });
    </script>
@endif
@if($errors->has('return-date'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: '{{ $errors->first('return-date') }}',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'swal-custom-popup',
                icon: 'swal-custom-icon',
                title: 'swal-custom-title',
                text: 'swal-custom-text',
                confirmButton: 'swal-custom-confirm',
                cancelButton: 'swal-custom-cancel'
            }
        });
    </script>
@endif