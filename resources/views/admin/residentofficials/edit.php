<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css?v=<?php echo time(); ?>">

</head>
<body>

<div class="container">
    <div class="header">
        BRGY 216 OFFICIALS
    </div>

    <div class="officials-container">
        <div class="official-card">
            <img src="signal-2024-04-03-162015_002.png" alt="Barangay Captain">
            <p class="position">Barangay Captain</p>
            <p class="name">Kap. Butchoy Ignas</p>
            <button class="edit-button" onclick="openEditModal('Kap. Butchoy Ignas', 'Barangay Captain')">Edit</button>
        </div>
        <div class="official-card">
            <img src="https://via.placeholder.com/100" alt="Barangay Treasurer">
            <p class="position">Barangay Treasurer</p>
            <p class="name">Tre. Lorem Ipsum</p>
            <button class="edit-button" onclick="openEditModal('Tre. Lorem Ipsum', 'Barangay Treasurer')">Edit</button>
        </div>
        <div class="official-card">
            <img src="https://via.placeholder.com/100" alt="Barangay Secretary">
            <p class="position">Barangay Secretary</p>
            <p class="name">Sec. Jenny Galan</p>
            <button class="edit-button" onclick="openEditModal('Sec. Jenny Galan', 'Barangay Secretary')">Edit</button>
        </div>
        <div class="official-card">
            <img src="https://via.placeholder.com/100" alt="Barangay Kagawad">
            <p class="position">Barangay Kagawad</p>
            <p class="name">Kag. Rose DelaCruz</p>
            <button class="edit-button" onclick="openEditModal('Kag. Rose DelaCruz', 'Barangay Kagawad')">Edit</button>
        </div>
    </div>
</div>

<div class="overlay" id="overlay"></div>

<div class="edit-modal" id="editModal">
    <div class="modal-header">
        EDIT INFORMATION
    </div>
    <div class="modal-content">
        <label for="full-name">Full Name:</label>
        <input type="text" id="full-name" name="full-name">

        <label for="position">Position:</label>
        <input type="text" id="position" name="position">

        <img src="https://via.placeholder.com/100" alt="Official Image">
    </div>
    <div class="modal-buttons">
        <button class="modal-button save-button" onclick="closeEditModal()">Save</button>
        <button class="modal-button cancel-button" onclick="closeEditModal()">Cancel</button>
    </div>
</div>

<script>
    function openEditModal(name, position) {
        document.getElementById('full-name').value = name;
        document.getElementById('position').value = position;
        document.getElementById('editModal').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
</script>

</body>
</html>