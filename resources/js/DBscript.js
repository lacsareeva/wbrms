import './bootstrap';

import Alpine from 'alpinejs';

import Swal from 'sweetalert2';

window.Alpine = Alpine;

Alpine.start();

let logoutTime = 10 * 60 * 1000; // 15 minutes in milliseconds
let timeout;

function resetTimer() {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        window.location.href = `login`; // Redirect to logout
    }, logoutTime);
}

// Reset timer on user activity
window.onload = resetTimer;
document.onmousemove = resetTimer;
document.onkeypress = resetTimer;
document.onclick = resetTimer;
document.onscroll = resetTimer;
window.resetTimer = resetTimer;
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

function checkUserType() {
    const userType = window.userType; // Get user type from Laravel
    const userTypesSidebar = document.getElementById('usertypes');

    if (userType !== "Admin") {
        userTypesSidebar.style.display = 'none';
    }
}

window.onload = checkUserType;

//  !-Toggle Navbar-- //
document.getElementById('profile-toggles').addEventListener('click', function () {
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
});

// Modify Sidebar Active Info
const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});

//Logout 
function confirmLogout() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You will be logged out of your account.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'logout',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the logout form
            document.getElementById('logout-form').submit();
        }
    });
}
window.confirmLogout = confirmLogout;

// TOGGLE SIDEBAR with Logo Modification
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');
const image = document.getElementById('imglogo');

// Store original dimensions and margin top
let originalWidth = image.width; 
let originalHeight = image.height; 
let originalMarginTop = window.getComputedStyle(image).marginTop; 

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
	if (image.width === originalWidth && image.height === originalHeight) {
        image.style.width = "50px";
        image.style.height = "50px";
        image.style.marginTop = "50px";
    } else {
        image.style.width = originalWidth + "px";
        image.style.height = originalHeight + "px";
        image.style.marginTop = originalMarginTop; 
    }
});

//Display Current Date and Time
const dateTimeElement = document.getElementById('datetime');

function updateDateTime() {
    const now = new Date();
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const dayOfWeek = days[now.getDay()];
    const date = now.toLocaleDateString('en-US');
    const time = now.toLocaleTimeString('en-US');
    dateTimeElement.innerHTML = `<p style="font-size:30px;font-weight:bold;margin-bottom:10px">${time} </p> 
                                 <p style="font-size:25px;font-weight:bold;margin-bottom:10px">${date} </p> 
                                 <p style="font-size:20px;font-weight:bold;">${dayOfWeek}</p>`;
}

updateDateTime();

setInterval(updateDateTime, 1000);
