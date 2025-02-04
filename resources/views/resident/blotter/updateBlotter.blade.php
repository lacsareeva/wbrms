<div id="update-walk-in-modal" class="modal" style="display=none;">
    <div class="modal-content">
        <span class="close" onclick="closeUpdateWalkInModal()">&times;</span>
        <h2>Update File Blotter</h2>
        <form id="update-form" method="POST">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="form-sections1">
                    <label for="incident-report">Incident Report</label><br>
                    <input type="text" id="update_incident_report" name="incident_report" placeholder="" autofocus
                        required>
                </div>
                <div class="form-sections2">
                    <label for="address">Address</label><br>
                    <input type="text" id="update_address" placeholder="Place of the incident." name="address">
                </div>
            </div>
            <div class="form-section">
                <div class="form-sections1">
                    <label for="date-time">Date and Time</label><br>
                    <input type="text" id="update_date_time" name="datetimes">
                </div>
                <div class="form-sections2">
                    <label for="complainant-name">Name of Complainant</label><br>
                    <input type="text" id="update_complainant_name" name="nameofcomplainant" readonly>
                </div>
            </div>
            <div class="form-section">
                <div class="form-sections1">
                    <label for="witness1">Name of Witness 1</label><br>
                    <input type="text" id="update_witness1" name="witness1">
                </div>
                <div class="form-sections2">
                    <label for="witness2">Name of Witness 2</label><br>
                    <input type="text" id="update_witness2" name="witness2">
                </div>
            </div>
            <div class="form-section">
                <div>
                    <label for="">NARRATIVE</label>
                    <textarea id="update_narrative" name="narrative" rows="5"
                        placeholder="Tell something about the incident."></textarea>
                </div>
                <input type="hidden" id="update_sender" name="sender">
            </div>
            <button type="submit" class="file-blotter-btn">UPDATE</button>
        </form>
    </div>
</div>