// Delete Announcement Function
function confirmRemove(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Once deleted, the staff account will be archived and cannot be retrieved.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
                window.location.href = `accounts/delete/${id}`;
        }
    });
}

window.confirmRemove = confirmRemove;
// ---------------------------------------

//  -- Update Container -- //
function openEditModal(admins) {
    document.getElementById('edit-account-modal').style.display = 'block';
    document.getElementById('update-name').value = admins.name || '';
    document.getElementById('update-mname').value = admins.mname || '';
    document.getElementById('update-lname').value = admins.lname || '';
    document.getElementById('update-suffix').value = admins.suffix || '';
    document.getElementById('update-password').value = admins.password || '';
    document.getElementById('update-email').value = admins.email || '';
    const form = document.getElementById('update-form');
    if (form) {
        form.action = `accounts/update/${admins.id}`;
    }
}
window.openEditModal = openEditModal;
//  ----------------------------------- //

//  --Form Validation-- //
const emailInput = document.getElementById('update-email');
const passInput = document.getElementById('update-password');
const conpassInput = document.getElementById('password_confirmation');
const form = document.getElementById('update-form'); 
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
function validateInputs() {
    let isValid = true;

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

    if (passInput.value.trim() === "") {
        setSuccess(passInput);
        passInput.classList.remove('invalid');
        passInput.classList.add('valid');
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

    if (conpassInput.value.trim() === "") {
        setSuccess(conpassInput,'');
        conpassInput.classList.remove('invalid');
        conpassInput.classList.add('valid');
    }
    else if (conpassInput.value !== passInput.value) {
        setError(conpassInput, "password doesn't match*");
        conpassInput.classList.add('invalid');
        conpassInput.classList.remove('valid');
        isValid = false;
    } else {
        setSuccess(conpassInput,'');
        conpassInput.classList.remove('invalid');
        conpassInput.classList.add('valid');
    }
    return isValid;
}
[
    emailInput,
    passInput,
    conpassInput,
].forEach((input) => {
    input.addEventListener('input', validateInputs);
    input.addEventListener('change', validateInputs);
});

form.addEventListener('submit', function (e) {
    if (!validateInputs()) {
        e.preventDefault();
    }
});
//  ----------------------------------- //
const emailInputs = document.getElementById('create_email');
const passInputs = document.getElementById('create_password');
const conpassInputs = document.getElementById('create_password_confirmation');
const forms = document.getElementById('create_form'); 
const setErrors = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success')
}
const setSuccesss = (element) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error')
}
function validateInput() {
    let isValid = true;

    if (emailInputs.value.trim() === "") {
        setError(emailInputs, 'email is required*');
        emailInputs.classList.add('invalid');
        emailInputs.classList.remove('valid');
        isValid = false;
    }
    else if (!emailInputs.value.includes("@")) {
        setError(emailInputs, 'please provide @ in your email address*');
        emailInputs.classList.add('invalid');
        emailInputs.classList.remove('valid');
        isValid = false;
    } else {
        setSuccess(emailInputs);
        emailInputs.classList.remove('invalid');
        emailInputs.classList.add('valid');
    }

    if (passInputs.value.trim() === "") {
        setSuccess(passInputs);
        passInputs.classList.remove('invalid');
        passInputs.classList.add('valid');
    }
    else if (passInputs.value.length < 8) {
        setError(passInputs, 'password must be atleast 8 character*');
        passInputs.classList.add('invalid');
        passInputs.classList.remove('valid');
        isValid = false;
    }
    else {
        setSuccess(passInputs);
        passInputs.classList.remove('invalid');
        passInputs.classList.add('valid');
    }

    if (conpassInputs.value.trim() === "") {
        setSuccess(conpassInputs,'');
        conpassInputs.classList.remove('invalid');
        conpassInputs.classList.add('valid');
    }
    else if (conpassInputs.value !== passInputs.value) {
        setError(conpassInputs, "password doesn't match*");
        conpassInputs.classList.add('invalid');
        conpassInputs.classList.remove('valid');
        isValid = false;
    } else {
        setSuccess(conpassInputs,'');
        conpassInputs.classList.remove('invalid');
        conpassInputs.classList.add('valid');
    }
    return isValid;
}
[
    emailInputs,
    passInputs,
    conpassInputs,
].forEach((input) => {
    input.addEventListener('input', validateInput);
    input.addEventListener('change', validateInput);
});

forms.addEventListener('submit', function (e) {
    if (!validateInput()) {
        e.preventDefault();
    }
});

// ---------------------------------------

//  --Open Close Modal-- //
function closeEditModal() {
    document.getElementById('edit-account-modal').style.display = 'none';
}
window.closeEditModal = closeEditModal;

function closeAddModal() {
    document.getElementById('add-account-modal').style.display = 'none';
}
window.closeAddModal = closeAddModal;

function openAddAccountModal() {
    document.getElementById('add-account-modal').style.display = 'block';
}
window.openAddAccountModal = openAddAccountModal;
//  ----------------------------------- //

document.getElementById('create_name').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

document.getElementById('create_mname').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

document.getElementById('create_lname').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});
//  !-- String Function--//