<div id="view-request-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeRequestModal()">&times;</span>
        <h2>View Request Document</h2>
        <form id="view-form" method="POST" action="">
            @csrf
            @method('POST')

            <input type="hidden" id="view_id" name="id">

            <p><strong>Fullname:</strong> <span id="view_fullname"></span></p>
            <p><strong>Age:</strong> <span id="view_age"></span></p>
            <p><strong>Postal Address:</strong> <span id="view_address"></span></p>
            <p><strong>Purpose:</strong> <span id="view_purpose"></span></p>
            <p><strong>Date Request:</strong> <span id="view_request_date"></span></p>
            <p style="display:none;"><strong>Date Request:</strong> <span id="view_request_type"></span></p>
            <div class="view-btn">
                <button id="accept_button" type="button" onclick="handleAcceptRequest()"
                    class="accept-btn">ACCEPT</button>
                <button id="reject_button" type="button" class="reject-btn">REJECT</button>
            </div>
        </form>
        <!-- Rejected Response Section -->
        <form id="reject-form" method="POST" action="{{ route('admin.records.delete', ':id') }}">
            @csrf
            @method('POST')
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

<div id="view-residentrequest-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeRequestResModal()">&times;</span>
        <h2>View Request Document</h2>
        <form id="view-R-form" method="POST" action="">
            @csrf
            @method('POST')

            <input type="hidden" id="view_R_id" name="id">

            <p><strong>Fullname:</strong> <span id="view_R_fullname"></span></p>
            <p><strong>Age:</strong> <span id="view_R_age"></span></p>
            <p><strong>Postal Address:</strong> <span id="view_R_address"></span></p>
            <p><strong>Date Request:</strong> <span id="view_R_request_date"></span></p>
            <p style="display:none;"><strong>Request Type:</strong> <span id="view_R_request_type"></span></p>

            <div class="view-btn">
                <button id="accept_R_button" type="button" onclick="handleAcceptResRequest()"
                    class="accept-btn">ACCEPT</button>
                <button id="reject_R_button" type="button" class="reject-btn">REJECT</button>
            </div>
        </form>

        <form id="reject-R-form" method="POST" action="{{ route('admin.records.delete', ':id') }}">
            @csrf
            @method('POST')
            <div id="response_r_rejected_info" class="response-info" style="display:none;">
                <div id="response-rejected-modal" class="response-rejected-modal">
                    <span class="close" onclick="closeResModal()">&times;</span>
                    <input type="text" id="view_r_rejected_status" name="status" value="rejected" hidden>
                    <strong>Send Response:</strong> <br>
                    <textarea id="view_r_rejected_response" name="response" rows="4"
                        placeholder="Provide a message for the resident..."></textarea>
                    <button type="button" class="reject-btn" onclick="rejectResRequest()">SEND</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Business Permit Request -->
<div id="view-businessrequest-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeRequestBusModal()">&times;</span>
        <h2>View Request Document</h2>
        <form id="view-B-form" method="POST" action="">
            @csrf
            <input type="hidden" id="view_B_id" name="id">

            <p><strong>Business Name:</strong> <span id="view_B_requirement"></span></p>
            <p><strong>Registered Owner:</strong> <span id="view_B_fullname"></span></p>
            <p><strong>Business Address:</strong> <span id="view_B_address"></span></p>
            <p><strong>Date Request:</strong> <span id="view_B_request_date"></span></p>

            <div class="view-btn">
                <button id="accept_B_button" type="button" onclick="handleAcceptBusRequest()"
                    class="accept-btn">ACCEPT</button>
                <button id="reject_B_button" type="button" class="reject-btn"
                    onclick="handleBusReject()">REJECT</button>
            </div>
        </form>

        <!-- Rejection Section -->
        <form id="reject-b-form" method="POST" action="{{ route('admin.records.delete', ':id') }}">
            @csrf
            @method('POST')
            <div id="response_b_rejected_info" class="response-info" style="display:none;">
                <div id="response-b-rejected-modal" class="response-rejected-modal">
                    <span class="close" onclick="closeBusModal()">&times;</span>
                    <input type="text" id="view_b_rejected_status" name="status" value="rejected" hidden>
                    <strong>Send Response:</strong> <br>
                    <textarea id="view_b_rejected_response" name="response" rows="4"
                        placeholder="Provide a message for the resident..."></textarea>
                    <button type="button" class="reject-btn" onclick="rejectBusRequest()">SEND</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if (session('downloadUrl'))
    <script>
        // Trigger download automatically
        window.onload = function () {
            const downloadUrl = "{{ session('downloadUrl') }}";
            const a = document.createElement('a');
            a.href = downloadUrl;
            a.download = downloadUrl.split('/').pop();
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        };
    </script>
@endif