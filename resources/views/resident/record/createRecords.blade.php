<div id="add-dialog" class="add-dialog" style="display: none;">
    <div class="dialog-content">
        <span class="close" onclick="closeWalkInRequestModal()">&times;</span>

        <h3>Request Document</h3>
        <div class="request-form">
            <div class="request-section">
                <div class="title-section">
                    <h4 style="margin-top:10px;">Request for Indigency</h4>
                </div>
                <form method="POST" action="{{ route('resident.record.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="details-section">
                        <label>Full Name: <br> <input id="fn" type="text" name="fullname"
                                value="{{ Auth::user()->name }} {{ Auth::user()->mname }} {{ Auth::user()->lname }} {{ Auth::user()->suffix }}"
                                readonly></label><br>
                        <label>Age: <br> <input type="number" name="age" required></label><br>
                        <label>Postal Address: <br> <textarea type="text" name="address" Placeholder=""
                                required></textarea><br></label>
                        <label>Purpose: <br> <input type="text" name="purpose" required></label><br>
                        <input type="text" name="requesttype" value=" Request for Indigency" hidden>
                        <input type="text" name="status" value="pending" hidden>
                        <input type="hidden" id="create_sender" name="sender" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="button-section">
                        <button type="submit" class="edit-buttons">ADD</button>
                    </div>
                </form>
            </div>
            <div class="request-section">
                <div class="title-section" style="height:188px;">
                    <h4 style="margin-top:10px;">Barangay Residency </h4>
                </div>
                <form method="POST" action="{{ route('resident.record.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="details-section">
                        <label>Full Name: <input id="Rfn" type="text" name="fullname"
                                value="{{ Auth::user()->name }} {{ Auth::user()->mname }} {{ Auth::user()->lname }} {{ Auth::user()->suffix }}"
                                readonly></label><br>
                        <label>Age: <input type="number" name="age" required></label><br>
                        <label>Postal Address: <br> <textarea type="text" name="address" Placeholder=""
                                required></textarea></label><br>
                        <input type="text" name="requesttype" value="Request for Residency" hidden>
                        <input type="text" name="status" value="pending" hidden>
                        <input type="hidden" id="create_sender" name="sender" value="{{ Auth::user()->email }}">

                    </div>
                    <div class="button-section" style="height:188px;">
                        <button type="submit" class="edit-buttons" style="margin-top: 145px">ADD</button>
                    </div>
                </form>
            </div>
            <div class="request-section">
                <div class="title-section" style="height:188px;">
                    <h4 style="margin-top:20px;">Business Permit</h4>
                </div>
                <form method="POST" action="{{ route('resident.record.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="details-section">
                        <label>BUSINESS NAME: <br> <input type="text" name="requirement" required></label><br>
                        <label>REGISTERED OWNER: <br> <input id="Bfn" type="text" name="fullname" required></label><br>
                        <label>BUSINESS ADDRESS: <br> <textarea type="text" name="address" Placeholder=""
                                required></textarea><br></label>
                        <input type="text" name="requesttype" value="Request for Business Permit" hidden>
                        <input type="text" name="status" value="pending" hidden>
                        <input type="hidden" id="create_sender" name="sender" value="{{ Auth::user()->email }}">

                    </div>
                    <div class="button-section" style="height:188px;">
                        <button type="submit" style="margin-top: 145px" class="edit-buttons">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="add-dialog-mobile" class="add-dialog" style="display: none;">
    <div class="dialog-contents">
        <span class="close" onclick="closeWalkInRequestModals()">&times;</span>

        <h3>Request Document</h3>
        <div class="request-forms">
            <div class="request-sections">
                <div class="title-sections">
                    <h4>Request for Indigency</h4>
                </div>
                <form method="POST" action="{{ route('resident.record.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="details-sections">
                        <label>Full Name: <br> <input id="fn" type="text" name="fullname"
                                value="{{ Auth::user()->name }} {{ Auth::user()->mname }} {{ Auth::user()->lname }} {{ Auth::user()->suffix }}"
                                readonly></label><br>
                        <label>Age: <br> <input type="number" name="age" required></label><br>
                        <label>Postal Address: <br> <textarea type="text" name="address" Placeholder=""
                                required></textarea><br></label>
                        <label>Purpose: <br> <input type="text" name="purpose" required></label><br>
                        <input type="text" name="requesttype" value=" Request for Indigency" hidden>
                        <input type="text" name="status" value="pending" hidden>
                        <input type="hidden" id="create_sender" name="sender" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="button-sections">
                        <button type="submit" class="edit-buttonss">ADD</button>
                    </div>
                </form>
            </div>
            <div class="request-sections">
                <div class="title-sections">
                    <h4>Barangay Residency </h4>
                </div>
                <form method="POST" action="{{ route('resident.record.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="details-sections">
                        <label>Full Name: <input id="Rfn" type="text" name="fullname"
                                value="{{ Auth::user()->name }} {{ Auth::user()->mname }} {{ Auth::user()->lname }} {{ Auth::user()->suffix }}"
                                readonly></label><br>
                        <label>Age: <input type="number" name="age" required></label><br>
                        <label>Postal Address: <br> <textarea type="text" name="address" Placeholder=""
                                required></textarea></label><br>
                        <input type="text" name="requesttype" value="Request for Residency" hidden>
                        <input type="text" name="status" value="pending" hidden>
                        <input type="hidden" id="create_sender" name="sender" value="{{ Auth::user()->email }}">

                    </div>
                    <div class="button-sections">
                        <button type="submit" class="edit-buttonss">ADD</button>
                    </div>
                </form>
            </div>
            <div class="request-sections">
                <div class="title-sections">
                    <h4>Business Permit</h4>
                </div>
                <form method="POST" action="{{ route('resident.record.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="details-sections">
                        <label>Business Name: <br> <input type="text" name="requirement" required></label><br>
                        <label>Registered Owner: <br> <input id="Bfn" type="text" name="fullname"  value="{{ Auth::user()->name }} {{ Auth::user()->mname }} {{ Auth::user()->lname }} {{ Auth::user()->suffix }}"
                        readonly></label><br>
                        <label>Business Address: <br> <textarea type="text" name="address" Placeholder=""
                                required></textarea><br></label>
                        <input type="text" name="requesttype" value="Request for Business Permit" hidden>
                        <input type="text" name="status" value="pending" hidden>
                        <input type="hidden" id="create_sender" name="sender" value="{{ Auth::user()->email }}">

                    </div>
                    <div class="button-sections">
                        <button type="submit" class="edit-buttonss">ADD</button>
                    </div>
                </form>
            </div>
        </div>
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