<div id="response_rejected_info" class="response-info" style="display:none;">
    <div id="response-rejected-modal" class="response-rejected-modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <input type="text" id="view_rejected_status" name="status" value="rejected">
        <strong>Response:</strong> <br>
        <textarea id="view_rejected_response" name="response" rows="3"
            placeholder="Relay a message for the resident (e.g., 'Unfortunately, we cannot fulfill this request.')"></textarea>
        <button type="button" class="reject-btn" onclick="rejectRequest()">SEND</button>
    </div>
</div>