// Open Add Document Function
function openAddDialog() {
    const addDialog = document.getElementById('add-dialog');
    addDialog.style.display = 'block';
}
window.openAddDialog = openAddDialog;

// Close Add Document Function
function closeWalkInRequestModal() {
    document.getElementById('add-dialog').style.display = 'none';
}
window.closeWalkInRequestModal = closeWalkInRequestModal;

// Close View Document Function(IndigencyContainer)
function closeRequestModal() {
    document.getElementById('view-request-modal').style.display = 'none';
}
window.closeRequestModal = closeRequestModal;

function closeModal() {
    document.getElementById('response_rejected_info').style.display = 'none';
    document.getElementById('view_rejected_response').value = '';
}
window.closeModal = closeModal;

// Close View Document Function(ResidencyContainer)
function closeResModal() {
    document.getElementById('response_r_rejected_info').style.display = 'none';
    document.getElementById('view_r_rejected_response').value = '';
}
window.closeResModal = closeResModal;

function closeRequestResModal() {
    document.getElementById('view-residentrequest-modal').style.display = 'none';
}
window.closeRequestResModal = closeRequestResModal;

// Close View Document Function(BusinessPermitContainer)
function closeBusModal() {
    document.getElementById('response_b_rejected_info').style.display = 'none';
    document.getElementById('view_b_rejected_response').value = '';
}
window.closeBusModal = closeBusModal;

function closeRequestBusModal() {
    document.getElementById('view-businessrequest-modal').style.display = 'none';
}
window.closeRequestBusModal = closeRequestBusModal;

// Close Update Document Function(Indigency and Residency)
function closeUpdateRequestModal() {
    document.getElementById('view-updateRequest-modal').style.display = 'none';
}
window.closeUpdateRequestModal = closeUpdateRequestModal;

// Close Update Document Function (BusinessPermit)
function closeUpdateBPRequestModal() {
    document.getElementById('view-update-BP-Request-modal').style.display = 'none';
}
window.closeUpdateBPRequestModal = closeUpdateBPRequestModal;

// convertToMilitaryTime
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

// Function to handle viewing of records
function viewRecords(record) {
    const requestType = record.requesttype || '';

    if (requestType === 'Request for Indigency') {
        document.getElementById('view-request-modal').style.display = 'block';

        document.getElementById('view_id').value = record.id || '';
        document.getElementById('view_fullname').textContent = record.fullname || '';
        document.getElementById('view_age').textContent = record.age || '';
        document.getElementById('view_address').textContent = record.address || '';
        document.getElementById('view_request_date').textContent = convertToMilitaryTime(record.created_at || '');
        document.getElementById('view_purpose').textContent = record.purpose || '';

        document.getElementById('reject_button').onclick = handleReject;

    } else if (requestType === 'Request for Residency') {
        document.getElementById('view-residentrequest-modal').style.display = 'block';

        document.getElementById('view_R_id').value = record.id || '';
        document.getElementById('view_R_fullname').textContent = record.fullname || '';
        document.getElementById('view_R_age').textContent = record.age || '';
        document.getElementById('view_R_address').textContent = record.address || '';
        document.getElementById('view_R_request_date').textContent = convertToMilitaryTime(record.created_at || '');

        document.getElementById('reject_R_button').onclick = handleResReject;
    }
    else if (requestType === 'Request for Business Permit') {
        document.getElementById('view-businessrequest-modal').style.display = 'block';

        document.getElementById('view_B_id').value = record.id || '';
        document.getElementById('view_B_requirement').textContent = record.requirement || 'N/A';
        document.getElementById('view_B_fullname').textContent = record.fullname || '';
        document.getElementById('view_B_address').textContent = record.address || '';
        document.getElementById('view_B_request_date').textContent = convertToMilitaryTime(record.created_at || '');

        document.getElementById('reject_B_button').onclick = handleBusReject;
    }
}
window.viewRecords = viewRecords;

// Function to reject a indigency permit request

function handleReject(event) {
    event.preventDefault();
    document.getElementById('response_rejected_info').style.display = 'block';
}
window.handleReject = handleReject;

function rejectRequest() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            const recordId = document.getElementById('view_id').value;
            const responseText = document.getElementById('view_rejected_response').value;

            if (!recordId.trim()) {
                Swal.fire('Error!', 'No record selected.', 'error');
                return;
            }

            if (!responseText.trim()) {
                Swal.fire('Error!', 'Please provide a response.', 'error');
                return;
            }

            const rejectForm = document.getElementById('reject-form');
            rejectForm.action = rejectForm.action.replace(':id', recordId);
            rejectForm.submit();
        }
    });
}
window.rejectRequest = rejectRequest;

// Function to reject a residency permit request

function handleResReject(event) {
    event.preventDefault();
    document.getElementById('response_r_rejected_info').style.display = 'block';
}

window.handleResReject = handleResReject;

function rejectResRequest() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            const recordId = document.getElementById('view_R_id').value;
            const responseText = document.getElementById('view_r_rejected_response').value;

            if (!recordId.trim()) {
                Swal.fire('Error!', 'No record selected.', 'error');
                return;
            }

            if (!responseText.trim()) {
                Swal.fire('Error!', 'Please provide a response.', 'error');
                return;
            }

            const rejectForm = document.getElementById('reject-R-form');
            rejectForm.action = rejectForm.action.replace(':id', recordId);
            rejectForm.submit();
        }
    });
}
window.rejectResRequest = rejectResRequest;


// Function to reject a business permit request

function handleBusReject(event) {
    if (event) event.preventDefault();
    document.getElementById('response_b_rejected_info').style.display = 'block';
}
window.handleBusReject = handleBusReject;

function rejectBusRequest() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            const recordId = document.getElementById('view_B_id').value;
            const responseText = document.getElementById('view_b_rejected_response').value;

            // Validate record ID and response text
            if (!recordId.trim()) {
                Swal.fire('Error!', 'No record selected.', 'error');
                return;
            }
            if (!responseText.trim()) {
                Swal.fire('Error!', 'Please provide a response.', 'error');
                return;
            }

            const rejectForm = document.getElementById('reject-b-form');

            // Ensure `:id` is replaced only once in the action URL
            rejectForm.action = rejectForm.action.replace(':id', recordId);

            // Submit the form
            rejectForm.submit();
        }
    });
}
window.rejectBusRequest = rejectBusRequest;

// handle Update Container
function editRecord(record) {
    const requestType = record.requesttype || '';

    if (requestType === 'Request for Indigency') {

        document.getElementById('view-updateRequest-modal').style.display = 'block';

        document.getElementById('update_fullname').value = record.fullname || '';
        document.getElementById('update_age').value = record.age || '';
        document.getElementById('update_address').value = record.address || '';
        document.getElementById('update_purpose').value = record.purpose || '';

        const form = document.getElementById('update-form');
        if (form && record.id) {
            form.action = `records/update/${record.id}`;
        }
    }
    else if (requestType === 'Request for Residency') {

        document.getElementById('view-updateRequest-modal').style.display = 'block';

        document.getElementById('update_fullname').value = record.fullname || '';
        document.getElementById('update_age').value = record.age || '';
        document.getElementById('update_address').value = record.address || '';

        document.getElementById('update_purpose').style.display = 'none';
        document.getElementById('purpose').style.display = 'none';
        const form = document.getElementById('update-form');
        if (form && record.id) {
            form.action = `records/update/${record.id}`;
        }
    }

    else if (requestType === 'Request for Business Permit') {

        document.getElementById('view-update-BP-Request-modal').style.display = 'block';

        document.getElementById('update_requirement').value = record.requirement || '';
        document.getElementById('update_fullnames').value = record.fullname || '';
        document.getElementById('update_addresss').value = record.address || '';

        const form = document.getElementById('update-bp-form');
        if (form && record.id) {
            form.action = `records/update/${record.id}`;
        }
    }
}
window.editRecord = editRecord;

// Search Function with Data Count Update
function filterTable() {
    const input = document.getElementById('search');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('recordTable');
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

    const countValue = document.getElementById('countValue');
    countValue.textContent = `${visibleRowCount} of ${totalRowCount}`;
}

window.filterTable = filterTable;

// handle accept request and generate certificate
function handleAcceptRequest() {
    Swal.fire({
        title: 'Process request?',
        text: "Are you sure you want to process this document?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            const id = document.getElementById('view_id').value;
            if (id) {
                window.location.href = `records/IndigencyCertificate/${id}`;
            } else {
                alert('No request ID found!');
            }
        }
    });
}
window.handleAcceptRequest = handleAcceptRequest;

// handle accept request and generate certificate
function handleAcceptResRequest() {
    Swal.fire({
        title: 'Process request?',
        text: "Are you sure you want to process this document?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {

            const id = document.getElementById('view_R_id').value;
            
            if (id) {
                window.location.href = `records/ResidencyCertificate/${id}`;
            } else {
                alert('No request ID found!');
            }
        }
    });
}
window.handleAcceptResRequest = handleAcceptResRequest;

// handle accept request and generate certificate
function handleAcceptBusRequest() {

    Swal.fire({
        title: 'Process request?',
        text: "Are you sure you want to process this document?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Check if the ID exists
            const id = document.getElementById('view_B_id').value;
            if (id) {
                // Redirect to the appropriate URL
                window.location.href = `records/BussinessPermitCertificate/${id}`;
            } else {
                // Use Swal for error message instead of alert
                Swal.fire('Error!', 'No request ID found. Please check again.', 'error');
            }
        }
    });
}
window.handleAcceptBusRequest = handleAcceptBusRequest;

// handle removing request if the document is pickup
function confirmDelete(id) {
    Swal.fire({
        title: 'document pickup?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Return',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `records/deletes/${id}`;
        }
    });
}
window.confirmDelete = confirmDelete;


//  -- String Function--//
document.getElementById('fn').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

document.getElementById('Rfn').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

document.getElementById('Bfn').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});
//  !-- String Function--//