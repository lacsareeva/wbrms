import '../bootstrap';

import Alpine from 'alpinejs';

import Swal from 'sweetalert2';

window.Alpine = Alpine;

Alpine.start();

//  !--Login-Alerts-- //
function showLoginAlert() {
    Swal.fire({
        icon: 'success',
        title: 'Login Successful',
        text: 'You have successfully logged in!',
        timer: 3000,
        showConfirmButton: false
    });
}
window.showLoginAlert = showLoginAlert;


//  -- Id-Image Transition  Function--//
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('profilePictures');
        if (output) {
            output.src = reader.result;
        } else {
            console.error("Image element not found!");
        }
    };

    if (event.target.files && event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    } else {
        console.error("No file selected!");
    }
}

function resetImage() {
    var output = document.getElementById("profilePictures");
    if (output) {
        output.src = defaultImageUrl;
    } else {
        console.error("Image element not found!");
    }
}

window.previewImage = previewImage;
window.resetImage = resetImage;

//  !-- Id-Image Transition  Function--//

//  -- String Function--//
document.getElementById('name').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

document.getElementById('mname').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

document.getElementById('lname').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

document.getElementById('suffix').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

//  !-- String Function--//

function toggleInput(select) {
    var customInput = document.getElementById("customInput");
    var verification_ids = document.getElementById("verification_id");
    if (select.value === "Other ID") {
        customInput.style.display = "block";
        verification_ids.style.display = "none";
        customInput.name = "verification_id"; // Change name so it gets submitted
    } else {
        customInput.style.display = "none";
        verification_ids.style.display = "block";
        customInput.name = "custom_input"; // Keep name different to avoid submission
    }
}
window.toggleInput = toggleInput;