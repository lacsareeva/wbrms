
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