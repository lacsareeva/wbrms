import './bootstrap';

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

// Error Message Function

document.addEventListener("DOMContentLoaded", function () {
    const errorModalElement = document.getElementById('errorModal');

    if (errorModalElement) {
        // Show the modal if there is an error
        errorModalElement.style.display = 'flex';

        // Expose a function to close the modal
        window.closeErrorMessageModal = function () {
            errorModalElement.style.display = 'none';
        };
    }
});

//  Birthdate Function

const monthSelect = document.getElementById('month');
const daySelect = document.getElementById('day');
const yearSelect = document.getElementById('year');

function updateDays() {
    const month = parseInt(monthSelect.value);
    const year = parseInt(yearSelect.value) || new Date().getFullYear(); // Default to current year if none is selected
    let daysInMonth;

    if (month === 2) {
        daysInMonth = (year % 4 === 0 && (year % 100 !== 0 || year % 400 === 0)) ? 29 : 28;
    } else if ([4, 6, 9, 11].includes(month)) {
        daysInMonth = 30;
    } else {
        daysInMonth = 31;
    }

    daySelect.innerHTML = '<option value="" disabled selected>Day</option>';

    for (let i = 1; i <= daysInMonth; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        daySelect.appendChild(option);
    }
}

monthSelect.addEventListener('change', updateDays);
//  !--Birthdate Function-- //

//  --Form Validation-- //
const nextButton = document.getElementById('nxt_btn');
const monSelect = document.getElementById('month');
const dySelect = document.getElementById('day');
const yrSelect = document.getElementById('year');
const genderSelect = document.getElementById('gender');
const fnInput = document.getElementById('name');
const mnInput = document.getElementById('mname');
const lnInput = document.getElementById('lname');
const emailInput = document.getElementById('email');
const passInput = document.getElementById('password');
const conpassInput = document.getElementById('password_confirmation');
const verId = document.getElementById('verification_id');
const verIdNumber = document.getElementById('id_number');
const imageoutput = document.getElementById("profilePictures");
const registerForm = document.getElementById('register-form');

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success')
}
const setSuccess = (element) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error')
}

const setErrors = (elements, messages) => {
    const inputControls = elements.parentElement;
    const errorDisplays = inputControls.querySelector('.errors');

    errorDisplays.innerText = messages;
    inputControls.classList.add('errors');
    inputControls.classList.remove('successs')
}
const setSuccesss = (elements) => {
    const inputControls = elements.parentElement;
    const errorDisplays = inputControls.querySelector('.errors');

    errorDisplays.innerText = '';
    inputControls.classList.add('successs');
    inputControls.classList.remove('errors')
}

function validateInputs() {
    let isValid = true;

    // Validate gender
    if (genderSelect.value === "") {
        // Display error message
        setError(genderSelect, 'Please select a gender*');
        genderSelect.classList.add('invalid');
        genderSelect.classList.remove('valid');
        isValid = false;
    } else {
        // Clear error message
        setSuccess(genderSelect);
        genderSelect.classList.remove('invalid');
        genderSelect.classList.add('valid');
    }

    // Validate email
    if (emailInput.value.trim() === "") {
        setError(emailInput, 'email is required*');
        emailInput.classList.add('invalid');
        emailInput.classList.remove('valid');
        isValid = false;
    }
    else if (!emailInput.value.includes("@")) {
        setError(emailInput, 'please provide @ in your email address*');
        emailInput.classList.add('invalid');
        emailInput.classList.remove('valid');
        isValid = false;
    } else {
        setSuccess(emailInput);
        emailInput.classList.remove('invalid');
        emailInput.classList.add('valid');

    }

    if (monSelect.value === "") {
        setError(monSelect, 'birth month cannot be empty*');
        monSelect.classList.add('invalid');
        monSelect.classList.remove('valid');
        isValid = false;
    } else {
        setSuccess(monSelect);
        monSelect.classList.remove('invalid');
        monSelect.classList.add('valid');
    }

    if (dySelect.value === "") {
        setError(dySelect, 'birth day cannot be empty*');
        dySelect.classList.add('invalid');
        dySelect.classList.remove('valid');
        isValid = false;
    } else {
        setSuccess(dySelect);
        dySelect.classList.remove('invalid');
        dySelect.classList.add('valid');
    }

    if (yrSelect.value === "") {
        setError(yrSelect, 'birth year cannot be empty*');
        yrSelect.classList.add('invalid');
        yrSelect.classList.remove('valid');
        isValid = false;
    } else {
        setSuccess(yrSelect);
        yrSelect.classList.remove('invalid');
        yrSelect.classList.add('valid');
    }

    if (fnInput.value.trim() === "") {
        setError(fnInput, 'first name cannot be empty*');
        fnInput.classList.add('invalid');
        fnInput.classList.remove('valid');
        isValid = false;
    } else {
        setSuccess(fnInput);
        fnInput.classList.remove('invalid');
        fnInput.classList.add('valid');

    }

    if (mnInput.value.trim() === "") {
        setError(mnInput, "middle name can't be empty*");
        mnInput.classList.add('invalid');
        mnInput.classList.remove('valid');
        isValid = false;
    } else {
        setSuccess(mnInput);
        mnInput.classList.remove('invalid');
        mnInput.classList.add('valid');
    }

    // Validate lastname
    if (lnInput.value.trim() === "") {
        setError(lnInput, 'last name cannot be empty*');
        lnInput.classList.add('invalid');
        lnInput.classList.remove('valid');
        isValid = false;
    } else {
        setSuccess(lnInput);
        lnInput.classList.remove('invalid');
        lnInput.classList.add('valid');
    }

    // Validate passwords
    if (passInput.value.trim() === "") {
        setError(passInput, 'password cannot be empty*');
        passInput.classList.add('invalid');
        passInput.classList.remove('valid');
        isValid = false;
    }
    else if (passInput.value.length < 8) {
        setError(passInput, 'password must be atleast 8 character*');
        passInput.classList.add('invalid');
        passInput.classList.remove('valid');
        isValid = false;
    }
    else {
        setSuccess(passInput);
        passInput.classList.remove('invalid');
        passInput.classList.add('valid');
    }

    // Validate confirm passwords
    if (conpassInput.value.trim() === "") {
        setError(conpassInput, 'Please confirm your password*');
        conpassInput.classList.add('invalid');
        conpassInput.classList.remove('valid');
        isValid = false;
    }
    else if (conpassInput.value !== passInput.value) {
        setError(conpassInput, "password doesn't match*");
        conpassInput.classList.add('invalid');
        conpassInput.classList.remove('valid');
        isValid = false;
    } else {
        setSuccess(conpassInput);
        conpassInput.classList.remove('invalid');
        conpassInput.classList.add('valid');
    }

    return isValid;
}

nextButton.addEventListener('click', function () {

    let currentContainer = 1;
    const nxt_btn = document.getElementById('nxt_btn');
    const isFormValid = validateInputs();

    if (isFormValid) {
        if (currentContainer === 1) {
            // Move container1 out and container2 in
            document.getElementById('container1').style.transform = 'translateX(-150%)';
            setTimeout(function () {
                document.getElementById('container1').style.display = 'none';
                document.getElementById('container2').style.display = 'block';
                document.getElementById('container2').style.transform = 'translateX(0)';
            }, 500);
            currentContainer = 2;
            nxt_btn.innerHTML = 'Next';
        }
    } else {
        [
            genderSelect,
            monSelect,
            dySelect,
            yrSelect,
            emailInput,
            fnInput,
            mnInput,
            lnInput,
            passInput,
            conpassInput,
        ].forEach((input) => {
            input.addEventListener('input', validateInputs);
            input.addEventListener('change', validateInputs);
        });
    }
});

function validateInputs2() {
    let isValid2 = true;

    // Validate gender
    if (verId.value === "") {
        // Display error message
        setErrors(verId, 'This field cannot be empty*');
        verId.classList.add('invalid');
        verId.classList.remove('valid');
        isValid2 = false;
    } else {
        // Clear error message
        setSuccesss(verId);
        verId.classList.remove('invalid');
        verId.classList.add('valid');
    }

    if (verIdNumber.value.trim() === "") {
        setErrors(verIdNumber, 'This fields cannot be empty*');
        verIdNumber.classList.add('invalid');
        verIdNumber.classList.remove('valid');
        isValid2 = false;
    } else {
        setSuccesss(verIdNumber);
        verIdNumber.classList.remove('invalid');
        verIdNumber.classList.add('valid');

    }
    if (imageoutput.src === defaultImageUrl || !imageoutput.src) {
        setErrors(imageoutput, 'Image field cannot be empty*');
        imageoutput.classList.add('invalid');
        imageoutput.classList.remove('valid');
        isValid2 = false;
    } else {
        setSuccesss(imageoutput);
        imageoutput.classList.remove('invalid');
        imageoutput.classList.add('valid');
    }
    return isValid2;
}
registerForm.addEventListener('submit', function (event) {
   event.preventDefault();
    const isFormValid2 = validateInputs2();

    if (isFormValid2) {
        registerForm.submit();
    } else {
        [
            verId,
            verIdNumber,
            imageoutput,
        ].forEach((input) => {
            input.addEventListener('input', validateInputs2);
            input.addEventListener('change', validateInputs2);
            input.addEventListener('change', validateInputs2);
        });
     
    }
});

//  !--Form Validation-- //

//  --Event listener for 'Back' button--//
const back_btn = document.getElementById('back_btn');

back_btn.addEventListener('click', function () {
    document.getElementById('container2').style.transform = 'translateX(-150%)';
    setTimeout(function () {
        document.getElementById('container2').style.display = 'none';
        document.getElementById('container1').style.display = 'block';
        document.getElementById('container1').style.transform = 'translateX(0)';
    }, 500);
});
//  !--Event listener for 'Back' button--//

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