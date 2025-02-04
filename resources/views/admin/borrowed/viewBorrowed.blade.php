<div id="view-request-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeRequestModal()">&times;</span>
        <h2>View Request Equipment</h2>
        <form id="view-form" action="{{ route('admin.borrowed.delete', ':id') }}" method="POST">
            @csrf
            @method('DELETE')

            <input type="hidden" id="view_id" name="id">
            <input type="hidden" id="view_sender" name="sender">

            <p><strong>Equipment/ Materials:</strong> <span id="view_equipment"></span></p>
            <p><strong>Qty:</strong> <span id="view_quantity"></span></p>
            <p><strong>Purpose:</strong> <span id="view_purpose"></span></p>
            <p><strong>Full name:</strong> <span id="view_name"></span></p>
            <p><strong>Address:</strong> <span id="view_address"></span></p>
            <p><strong>Contact:</strong> <span id="view_contact"></span></p>
            <p><strong>Date & Time of Borrowing:</strong> <span id="view_borrow_date"></span></p>
            <p><strong>Date & Time of Return:</strong> <span id="view_return_date"></span></p>

            <div class="view-btn">
                <button id="accept_button" type="button" class="accept-btn">ACCEPT</button>
                <button id="reject_button" type="button" class="reject-btn">REJECT</button>
            </div>

            <!-- Rejected Response Section -->
            <div id="response_rejected_info" class="response-info" style="display:none;">
                <div id="response-rejected-modal" class="response-rejected-modal">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <input type="text" id="view_rejected_status" name="status" value="rejected" hidden>
                    <strong>Send Response:</strong> <br>
                    <textarea id="view_rejected_response" name="response" rows="4"
                        placeholder="Relay a message for the resident (e.g., 'Unfortunately, we cannot fulfill this request.')"></textarea>
                    <button type="button" class="reject-btn" onclick="rejectRequest()">SEND</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Accepted Response Section -->
<div id="response_accepted_info" class="response-info" style="display:none;">
    <div id="response-accepted-modal" class="response-accepted-modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <form id="update-forms" action="{{ route('admin.borrowed.updates', ':id') }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="text" id="view_ids" name="id" hidden>
            <input type="text" id="view_accepted_status" name="status" value="Accepted" hidden>
            <strong>Send Response:</strong> <br>
            <textarea id="view_accepted_response" name="response" rows="4"
                placeholder="Relay a message for the resident (e.g., 'Request accepted, please proceed to the barangay hall to pick up the equipment')"></textarea>
            <button type="button" class="accept-btn" onclick="acceptRequest()">SEND</button>
        </form>
    </div>
</div>