<div id="update-announcement-modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModals()">&times;</span>
        <h2>Announcement Information</h2>
        <form id="update-form" method="POST">
            @csrf
            @method('PUT')
            <div class="form-section">
                <label for="title">TITLE</label>
                <input type="text" id="update_title" name="title" >
            </div>
            <div class="form-section">
                <label for="what">WHAT</label>
                <textarea id="update_what" name="what"></textarea>
            </div>
            <div class="form-section">
                <label for="when">WHEN</label>
                <input type="text" id="update_when" name="when">
            </div>
            <div class="form-section">
                <label for="where">WHERE</label>
                <input type="text" id="update_where" name="where">
            </div>
            <div class="form-section">
                <label for="other-info">OTHER INFO: (REQUIREMENTS)</label>
                <textarea id="update_other_info" name="otherInfo" rows="5"></textarea>

            </div>
            <div class="form-section">
                <div class="button">
                    <button type="submit" class="post-btn">Update</button>
                
                </div>
            </div>
        </form>
    </div>
</div>