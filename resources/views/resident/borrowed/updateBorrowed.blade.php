<div id="update-request-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUpdateWalkInRequestModal()">&times;</span>
        <h2>Update Request</h2>
        <form id="update-form" method="POST">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="form-section1">
                    <label for="first-name">Fullname:</label><br>
                    <input type="text" id="update_name" name="name" readonly> 
                </div>
                <div class="form-section2">
                    <label for="address">Address:</label><br>
                    <input type="text" id="update_address" name="address">
                </div>
            </div>
            <div class="form-section">
                <div class="form-section1">
                    <label for="equipment">Equipment / Materials</label><br>
                    <select id="update_equipment" name="equipment" onchange="toggleInputs(this)">
                        <option value="">Select Equipment</option>
                        <option value="Chair">Chair</option>
                        <option value="Tent">Tent</option>
                        <option value="Ladder">Ladder</option>
                        <option value="other">Other</option>
                    </select>
                    <input type="text" id="customInputs" name="equipment" style="display:none;"
                        placeholder="Enter custom value">
                </div>
                <div class="form-section2">
                    <label for="quantity">Qty.</label><br>
                    <input type="number" id="update_quantity" name="quantity">
                </div>
            </div>
            <div class="form-section">
                <div class="form-section1">
                    <label for="purpose">Purpose</label><br>
                    <input type="text" id="update_purpose" name="purpose">
                </div>
                <div class="form-section2">
                    <label for="contact">Contact No.</label><br>
                    <input type="text" id="update_contact" name="contact">
                </div>
            </div>
            <div class="form-section">
                <div class="form-section1">
                    <label for="borrow-date">Date and Time of Borrowing</label><br>
                    <input type="datetime-local" id="update_borrow_date" name="borrow-date" required>
                </div>
                <div class="form-section2">
                    <label for="return-date">Date and Time of Return</label><br>
                    <input type="datetime-local" id="update_return_date" name="return-date" required>
                </div>
            </div>
            <div class="form-section">
                <input type="hidden" id="update_sender" name="sender" value="{{ Auth::user()->email }}">
            </div>

            <div class="form-section">
                <button type="submit" class="proceed-btn">UPDATE</button>
            </div>
        </form>
    </div>
</div>
@if($errors->has('return-date'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: '{{ $errors->first('return-date') }}',
        confirmButtonText: 'OK',
    });
</script>
@endif