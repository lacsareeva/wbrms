<div id="view-updateRequest-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUpdateRequestModal()">&times;</span>
        <h2>Update Request Document</h2>
        <form id="update-form" method="POST">
            @csrf
            @method('PUT')

            <div id="IR" class="form-section">

                <input type="hidden" id="update_id" name="id">

                <label for="">Fullname:</label><br>
                <input type="text" name="fullname" id="update_fullname"><br>

                <label for="">Age:</label><br>
                <input type="number" name="age" id="update_age"><br>

                <label for="">Address:</label><br>
                <input type="text" name="address" id="update_address"><br>

                <label for="" id="purpose">Purpose:</label><br>
                <input type="text" name="purpose" id="update_purpose"><br>

            </div>

            <div class="form-section">
                <button type="submit" class="update-buttons">UPDATE</button>
            </div>

        </form>
    </div>
</div>

<div id="view-update-BP-Request-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUpdateBPRequestModal()">&times;</span>
        <h2>Update Request Document</h2>
        <form id="update-bp-form" method="POST">
            @csrf
            @method('PUT')

            <div id="BP" class="form-section">

                <input type="hidden" id="update_ids" name="id">

                <label for="">Business Name:</label><br>
                <input type="text" name="requirement" id="update_requirement"><br>

                <label for="">Business Owner:</label><br>
                <input type="text" name="fullname" id="update_fullnames"><br>

                <label for="">Business Address:</label><br>
                <input type="text" name="address" id="update_addresss"><br>

            </div>

            <div class="form-section">
                <button type="submit" class="update-buttons">UPDATE</button>
            </div>

        </form>
    </div>
</div>