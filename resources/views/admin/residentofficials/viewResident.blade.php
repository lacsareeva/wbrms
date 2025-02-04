<div id="view-verify-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeVerifyModal()">&times;</span>
        <h2>Resident Verification Details</h2>
        <form id="view-forms" method="POST">
            @csrf

            <input type="hidden" id="view_id" name="id">
            <input type="hidden" id="view_email" name="email">
            <p><strong>Fullname: </strong> <span id="view_fullname"></span></p>
            <p><strong>Age: </strong> <span id="view_age"></span></p>
            <p><strong>Address: </strong> <span id="view_address"></span></p>
            <p><strong>Email</strong> <span id="view_email_display"></span></p>
            <p><strong>Resident Type: </strong> <span id="view_residenttype"></span></p>
            <p><strong>Gender: </strong> <span id="view_gender"></span></p>
            <p><strong>Date Register: </strong> <span id="view_dateRegister"></span></p>
            <p><strong>Verification ID: </strong> <span id="view_verificationID"></span></p>
            <p><strong>Verification ID Number: </strong> <span id="view_verificationIDnumber"></span></p>
            <p class="btn-datas">
                <strong>Verification ID Image: </strong>
                <img id="view_verificationIDimage" src="" alt="Verification Image" class="verifyImage">
            </p>
            <div class="view-btn">
                <button id="accept_button" type="button" onclick="handleAcceptRequest()"
                    class="accept-btn">ACCEPT</button>
                <button id="reject_button" type="button" class="reject-btn"
                    onclick="rejectRequest(event)">REJECT</button>
            </div>

            <!-- Rejected Response Section -->
            <div id="response_rejected_info" class="response-info" style="display:none;">
                <div id="response-rejected-modal" class="response-rejected-modal">
                    <span class="close" onclick="closeRejectModal()">&times;</span>
                    <input type="hidden" id="view_emails" name="email"> <!-- Ensure this input is populated -->
                    <strong>Send Reason for Rejection:</strong><br><br>
                    <textarea id="view_rejected_response" name="response" rows="5"
                        placeholder="Send a message to the resident for reason of not accepting their request "></textarea>
                   <br> <br><button type="button" class="reject-btn" onclick="handleRejectRequest()">SEND</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if(session('message'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ e(session('message')) }}",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Validation Error!',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>