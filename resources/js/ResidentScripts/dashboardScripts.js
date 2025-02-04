import '../bootstrap';

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
        setTimeout(() => {
            location.reload(); // Refresh the page after redirecting
        }, 1000); // Delay refresh to allow redirection
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
        showConfirmButton: false,
        customClass: {
            popup: 'swal-custom-popup',
            title: 'swal-custom-title',
            text: 'swal-custom-text'
        }
    });
}
window.showLoginAlert = showLoginAlert;


//  Toggle Navbar
document.getElementById('profile-toggles').addEventListener('click', function () {
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
});

// Modify Sidebar Active Info
const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        });
        li.classList.add('active');
    });
});

//Logout 
function confirmLogout() {
    Swal.fire({
        title: 'Are you sure you want to logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Logout',
        cancelButtonText: 'Cancel',
        customClass: {
            popup: 'swal-custom-popup',
            icon:'swal-custom-icon',
            title: 'swal-custom-title',
            text: 'swal-custom-text',
            confirmButton: 'swal-custom-confirm',
            cancelButton: 'swal-custom-cancel'
        }
    }).then((result) => {
        if (result.isConfirmed) {
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

// Automatically toggle sidebar and adjust for small screens
function handleResize() {
    const isSmallScreen = window.innerWidth <= 576; // Adjust threshold as needed
    const menuBar = document.querySelector('#content nav .bx.bx-menu');

    // Handle sidebar toggle for small screens
    if (isSmallScreen) {
        if (!sidebar.classList.contains('hide')) {
            sidebar.classList.add('hide');
            menuBar.onclick = false;
            image.style.width = "50px";
            image.style.height = "50px";
            image.style.marginTop = "10px"; 
            image.style.marginLeft = "0px";
        }
        sidebar.style.overflowY = "auto"; // Enable scrolling for overflow content
        menuBar.style.pointerEvents = "none"; // Disable menu bar interactions
        menuBar.style.opacity = "0"; // Optional: make the button look disabled
    } else {
        if (sidebar.classList.contains('hide')) {
            sidebar.classList.remove('hide');
            image.style.width = originalWidth + "px";
            image.style.height = originalHeight + "px";
            image.style.marginTop = originalMarginTop;
            menuBar.style.pointerEvents = "auto"; // Enable menu bar interactions
            menuBar.style.opacity = "1"; // Restore button appearance
        }
        sidebar.style.overflowY = "auto"; // Hide scrolling on larger screens
    }

    // Dynamically adjust sidebar height based on screen size
    const viewportHeight = window.innerHeight;
    sidebar.style.height = `${viewportHeight}px`; // Sidebar fills the viewport height
}

// Check screen size on load and resize
window.addEventListener('load', handleResize);
window.addEventListener('resize', handleResize);


// Display Current Date and Time
const dateTimeElement = document.getElementById('datetime');
function updateDateTime() {
    const now = new Date();
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const dayOfWeek = days[now.getDay()];
    const date = now.toLocaleDateString('en-US');
    const time = now.toLocaleTimeString('en-US');
    dateTimeElement.innerHTML = `<p style="font-size:20px;font-weight:bold;margin-bottom:10px; text-align:right; margin-right:8px">${time} 
                                 <span style="color:green;">${dayOfWeek}</span></p>`;
}

updateDateTime();
setInterval(updateDateTime, 1000);