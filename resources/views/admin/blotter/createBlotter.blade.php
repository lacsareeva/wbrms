<div id="walk-in-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeWalkInModal()">&times;</span>
        <div class="blotterContents">
            <h2>File Walk-In</h2>
            <form method="POST" action="{{ route('admin.blotter.save') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-section">
                    <div class="form-sections1">
                        <label for="incident-report">Incident Report</label><br>
                        <input type="text" id="incident-report" name="incident_report"
                            placeholder="ex. theft, bullying, etc" autofocus required>
                    </div>
                    <div class="form-sections2">
                        <label for="address">Address</label><br>
                        <input type="text" id="address" placeholder="Place of the incident." name="address" required>
                    </div>
                </div>
                <div class="form-section">
                    <div class="form-sections1">
                        <label for="date-time">Date and Time</label><br>
                        <input type="text" id="date-time" name="datetimes" placeholder="date and time when it happen"
                            required>
                    </div>
                    <div class="form-sections2">
                        <label for="complainant-name">Name of Complainant</label><br>
                        <input type="text" id="complainant-name" name="nameofcomplainant"
                            placeholder="input fullname, please avoid inputing aliases" required>
                    </div>
                </div>
                <div class="form-section">
                    <div class="form-sections1">
                        <label for="witness1">Name of Witness 1</label><br>
                        <input type="text" id="witness1" name="witness1" placeholder="type none if theres no witness"
                            required>
                    </div>
                    <div class="form-sections2">
                        <label for="witness2">Name of Witness 2</label><br>
                        <input type="text" id="witness2" name="witness2" placeholder="type none if theres no witness"
                            required>
                    </div>
                </div>
                <div class="form-section">
                    <div>
                        <label for="">NARRATIVE</label>
                        <textarea id="narrative" name="narrative" rows="5"
                            placeholder="Tell something about the incident." required></textarea>
                    </div>
                    <input type="hidden" id="sender" name="sender" value="{{ Auth::user()->email }}">
                </div>
                <button type="submit" class="file-blotter-btn">FILE BLOTTER</button>
            </form>
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
            showConfirmButton: false
        });
    </script>
@endif