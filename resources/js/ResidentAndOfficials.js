function openModal(name, age, contact, address, dateRegistered, status) {
    document.getElementById('fullName').value = name;
    document.getElementById('age').value = age;
    document.getElementById('contact').value = contact;
    document.getElementById('address').value = address;
    document.getElementById('dateRegistered').value = dateRegistered;
    document.getElementById('status').value = status;
    document.getElementById('editModal').style.display = 'flex';
}
window.openModal = openModal;

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}
window.closeModal = closeModal;

function saveResident() {
    alert('Resident information saved!');
    closeModal();
}
window.saveResident = saveResident;

function removeResident() {
    alert('Resident removed!');
    closeModal();
}
window.removeResident = removeResident;

function showSection(sectionId) {
    document.querySelectorAll('.container').forEach(container => {
        container.style.display = 'none';
    });
    document.getElementById(sectionId).style.display = 'block';

    const buttons = document.querySelectorAll('.report-btn button');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    switch (sectionId) {
        case 'residentsContainer':
            document.getElementById('residentsBtn').classList.add('active');
            break;
        case 'officialsContainer':
            document.getElementById('officialsBtn').classList.add('active');
            break;
        case 'verificationContainer':
            document.getElementById('verifyBtn').classList.add('active');
            break;
    }
}
window.showSection = showSection;

function openOfficialsModal(fullname, position, id, imageUrl) {
    // Populate the modal fields with data
    document.getElementById('officialId').value = id;
    document.getElementById('fullname').value = fullname;
    document.getElementById('position').value = position;
    const modalImage = document.getElementById('officialsimages');
    modalImage.src = imageUrl;
    // Show the modal
    document.getElementById('editOfficialsModal').style.display = 'block';

    // Dynamically update the form action with the correct ID
    const form = document.getElementById('editForms');
    if (form) {
        form.action = `resident-and-officials/${id}`; // Set the correct URL
    }
}

// Expose the function to the global scope
window.openOfficialsModal = openOfficialsModal;


function closeEditModal() {
    // Hide the modal
    document.getElementById('editOfficialsModal').style.display = 'none';
}
window.closeEditModal = closeEditModal;

function previewImage(event) {
    const fileInput = event.target; // Get the input element
    const imagePreview = document.getElementById('officialsimages'); // Get the image element

    // Check if a file is selected
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}
window.previewImage = previewImage;

function convertToMilitaryTime(dateString) {
    if (!dateString) return '';
    const date = new Date(dateString);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${year}-${month}-${day} ${hours}:${minutes}`;
}

// Function to handle viewing of verification residents
function viewResidents(user) {
    // Display the modal
    document.getElementById('view-verify-modal').style.display = 'block';
    document.getElementById('view_emails').value = user.email || '';
    // Populate fields with user data
    document.getElementById('view_id').value = user.id || '';
    document.getElementById('view_email').value = user.email || '';
    document.getElementById('view_fullname').textContent =
        `${user.name || ''} ${user.mname || ''} ${user.lname || ''} ${user.suffix || ''}`.trim();
    document.getElementById('view_age').textContent = user.age || '';
    document.getElementById('view_address').textContent = user.address || '';
    document.getElementById('view_email_display').textContent = user.email || '';
    document.getElementById('view_residenttype').textContent = user.residenttype || '';
    document.getElementById('view_gender').textContent = user.gender || '';
    document.getElementById('view_dateRegister').textContent = convertToMilitaryTime(user.created_at || '');
    document.getElementById('view_verificationID').textContent = user.verification_id || '';
    document.getElementById('view_verificationIDnumber').textContent = user.verification_id_number || '';

    // Set the image source for verification ID
    const verificationImage = document.getElementById('view_verificationIDimage');
    verificationImage.src = user.verification_id_image
        ? `/storage/${user.verification_id_image}` // Build the path dynamically
        : ''; // Fallback if no image is provided

    verificationImage.alt = user.verification_id_image ? 'Verification ID Image' : 'No image provided';

}

window.viewResidents = viewResidents;

function closeVerifyModal() {
    document.getElementById('view-verify-modal').style.display = 'none';
}
window.closeVerifyModal = closeVerifyModal;

function closeRejectModal() {
    document.getElementById('response_rejected_info').style.display = 'none';
    document.getElementById('view_rejected_response').value = '';
}
window.closeRejectModal = closeRejectModal;

function handleAcceptRequest() {
    Swal.fire({
        title: 'Accept request?',
        text: "Are you sure he/she is a verified resident?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            const email = document.getElementById('view_email').value;

            if (email) {
                // Set the form action dynamically
                const form = document.getElementById('view-forms');
                form.action = `resident-and-officials/verify/${encodeURIComponent(email)}`;
                form.submit();
            } else {
                alert('No email found!');
            }
        }
    });
}
window.handleAcceptRequest = handleAcceptRequest;

function handleRejectRequest() {
    const response = document.getElementById('view_rejected_response').value;
    const email = document.getElementById('view_emails').value;

    if (!response.trim()) {
        alert('Please provide a reason for rejection.');
        return;
    }

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `resident-and-officials/reject/${email}`;

    // Add CSRF token
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    form.innerHTML = `
        <input type="hidden" name="_token" value="${token}">
        <input type="hidden" name="response" value="${response}">
        <input type="hidden" name="email" value="${email}">
    `;

    document.body.appendChild(form);
    form.submit();
}

window.handleRejectRequest = handleRejectRequest;

function rejectRequest(event) {
    event.preventDefault();
    document.getElementById('response_rejected_info').style.display = 'block';
}

window.rejectRequest = rejectRequest;

function sortRejectedInfo() {
    const sortInfo = document.getElementById('SortRrejectedResidents').value;

    // Get containers for rejected and valid residents
    const validResidents = document.getElementById('validResidents');
    const rejectContainer = document.getElementById('rejectContainer');
    const removedContainer = document.getElementById('removedContainer');
    if (sortInfo === "REJECTED") {
        validResidents.style.display = 'none';
        rejectContainer.style.display = 'block';
        removedContainer.style.display = 'none';
    } else if (sortInfo === "VERIFIED") {
        validResidents.style.display = 'block';
        rejectContainer.style.display = 'none';
        removedContainer.style.display = 'none';
    }
    else if (sortInfo === "REMOVED") {
        rejectContainer.style.display = 'none';
        removedContainer.style.display = 'block';
        validResidents.style.display = 'none';
    } else {
        // Hide both if no valid selection is made
        validResidents.style.display = 'none';
        rejectContainer.style.display = 'none';
        removedContainer.style.display = 'none';
    }
}
window.sortRejectedInfo = sortRejectedInfo;

//Search Function onkeypress
function filterTable() {
    const input = document.getElementById('searchess');
    const filter = input.value.toLowerCase();
    let totalRowCount = 0;
    let visibleRowCount = 0;
    let totalRowCounts = 0;
    let visibleRowCounts = 0;
    let totalRowCountss = 0;
    let visibleRowCountss = 0;

    const visibleContainers = document.querySelectorAll('.containers');

    visibleContainers.forEach(container => {

        if (container.style.display !== 'none') {
            const table = container.querySelector('table');
            if (table) {
                const rows = table.getElementsByTagName('tr');
                let containerRowCount = 0;
                let containerVisibleCount = 0;
                let containerRowCounts = 0;
                let containerVisibleCounts = 0;
                let containerRowCountss = 0;
                let containerVisibleCountss = 0;
              
                const noDataRow = table.querySelector('#noDataRow');

                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const cells = row.getElementsByTagName('td');
                    let match = false;

                    if (row.id === 'noDataRow') continue;

                    containerRowCount++;
                    containerRowCounts++;
                    containerRowCountss++;
                    for (let j = 0; j < cells.length; j++) {
                        if (cells[j]) {
                            const cellValue = cells[j].textContent || cells[j].innerText;
                            if (cellValue.toLowerCase().includes(filter)) {
                                match = true;
                                break;
                            }
                        }
                    }

                    if (match) {
                        row.style.display = '';
                        containerVisibleCount++;
                        containerVisibleCounts++;
                        containerVisibleCountss++;
                    } else {
                        row.style.display = 'none';
                    }
                }

                if (noDataRow) {
                    noDataRow.style.display = containerVisibleCount === 0 ? '' : 'none';
                    noDataRow.style.display = containerVisibleCounts === 0 ? '' : 'none';
                    noDataRow.style.display = containerVisibleCountss === 0 ? '' : 'none';

                }
                totalRowCount += containerRowCount;
                visibleRowCount += containerVisibleCount;
                totalRowCounts += containerRowCounts;
                visibleRowCounts += containerVisibleCounts;
                totalRowCountss += containerRowCountss;
                visibleRowCountss += containerVisibleCountss;
            }
        }
    });

    const countValue = document.getElementById('countValue');
    countValue.textContent = `${visibleRowCount} of ${totalRowCount}`;
    const countValues = document.getElementById('countValues');
    countValues.textContent = `${visibleRowCounts} of ${totalRowCounts}`;
    const countValuess = document.getElementById('countValuess');
    countValuess.textContent = `${visibleRowCountss} of ${totalRowCountss}`;
}
window.filterTable = filterTable;

function filterTables() {
    const input = document.getElementById('searches');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('residentverifyTable');
    const rows = table.getElementsByTagName('tr');
    let totalRowCount = 0;
    let visibleRowCount = 0;

    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const cells = row.getElementsByTagName('td');
        let match = false;

        if (row.id === 'noDataRow') continue;

        totalRowCount++;

        for (let j = 0; j < cells.length; j++) {
            if (cells[j]) {
                const cellValue = cells[j].textContent || cells[j].innerText;
                if (cellValue.toLowerCase().includes(filter)) {
                    match = true;
                    break;
                }
            }
        }

        if (match) {
            row.style.display = '';
            visibleRowCount++;
        } else {
            row.style.display = 'none';
        }
    }

    const noDataRow = document.getElementById('noDataRow');
    noDataRow.style.display = visibleRowCount === 0 ? '' : 'none';

    const countValue = document.getElementById('countValuess');
    countValue.textContent = `${visibleRowCount} of ${totalRowCount}`;
}

window.filterTables = filterTables;

// Delete Announcement Function
function removeResidents(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "It can't be retrieved once deleted.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `resident-and-officials/deletes/${id}`;
        }
    });
}
window.removeResidents = removeResidents;