<div id="view-walk-in-modal" class="modal" style="display=none;">
    <div class="view-modal-content">
        <span class="close" onclick="closeViewWalkInModal()">&times;</span>
        <h2>Blotter Information</h2>
        <form id="delete-form" action="{{ route('admin.blotter.delete', ':id') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="form-sections">
                <div class="form-sectionss">
                    <span id="view_id" name="id" style="display:none;">{{ $blotters->id ?? ''}}</span>
                    <label for="incident-report">Incident Report:</label>
                    <span id="view_incident_report" name="incident_report"></span>
                </div>
                <div class="form-sectionss">
                    <label for="address">Address:</label>
                    <span id="view_address" name="address"></span>
                </div>
            </div>
            <div class="form-sections">
                <div class="form-sectionss">
                    <label for="date-time">Date and Time:</label>
                    <span id="view_date_time" name="datetimes"></span>
                </div>
                <div class="form-sectionss">
                    <label for="complainant-name">Name of Complainant:</label>
                    <span id="view_complainant_name" name="nameofcomplainant"></span>
                </div>
            </div>
            <div class="form-sections">
                <div class="form-sectionss">
                    <label for="witness1">Name of Witness 1:</label>
                    <span id="view_witness1" name="witness1"></span>
                </div>
                <div class="form-sectionss">
                    <label for="witness2">Name of Witness 2:</label>
                    <span id="view_witness2" name="witness2"></span>
                </div>
            </div>
            <input type="hidden" id="view_sender" name="sender">
            <div class="form-section4">
                <label for="">NARRATIVE:</label><br>
                <span id="view_narrative" name="narrative"></span>
                <span id="view_personIncharge" name="personIncharge" style="display:none;">Admin</span>
            </div>
            <div class="modal-actions">
                <button type="button" class="settle-btn" onclick="submitDeleteForm()">SETTLE</button>
                <button class="unsettle-btn" onclick="closeViewWalkInModal()">UNSETTLE</button>
            </div>
        </form>
    </div>
</div>