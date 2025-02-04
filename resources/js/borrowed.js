
const returnDateInput = document.getElementById('create_borrow_date');
const borrowDateInput = document.getElementById('create_return_date');
// Function to get the current date and time in the correct format for "datetime-local"

function getCurrentDateTime() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-based
    const date = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');

    return `${year}-${month}-${date}T${hours}:${minutes}`; // Format: YYYY-MM-DDTHH:mm
}

// Set the minimum value to the current date and time
const currentDateTime = getCurrentDateTime();
returnDateInput.min = currentDateTime;

const currentDateTime2 = getCurrentDateTime();
borrowDateInput.min = currentDateTime;

returnDateInput.value = currentDateTime;
borrowDateInput.value = currentDateTime;

function viewBorrowed(borrowed) {

    document.getElementById('view-request-modal').style.display = 'block';

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

    document.getElementById('view_id').value = borrowed.id || '';
    document.getElementById('view_ids').value = borrowed.id || '';
    document.getElementById('view_sender').value = borrowed.sender || '';
    document.getElementById('view_name').textContent = borrowed.name || '';
    document.getElementById('view_address').textContent = borrowed.address || '';
    document.getElementById('view_equipment').textContent = borrowed.equipment || '';
    document.getElementById('view_quantity').textContent = borrowed.quantity || '';
    document.getElementById('view_purpose').textContent = borrowed.purpose || '';
    document.getElementById('view_contact').textContent = borrowed.contact || '';
    document.getElementById('view_borrow_date').textContent = convertToMilitaryTime(borrowed['borrow-date'] || '');
    document.getElementById('view_return_date').textContent = convertToMilitaryTime(borrowed['return-date'] || '');

    const reject_btn = document.getElementById('reject_button');
    const accept_btn = document.getElementById('accept_button');

    reject_btn.replaceWith(reject_btn.cloneNode(true));
    accept_btn.replaceWith(accept_btn.cloneNode(true));

    document.getElementById('reject_button').addEventListener('click', function handleReject(e) {
        e.preventDefault();
        document.getElementById('response_accepted_info').style.display = 'none';
        document.getElementById('response_rejected_info').style.display = 'block';

        function rejectRequest(id = null) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const recordId = id || document.getElementById('view_id').value;

                    if (!recordId || recordId.trim() === '') {
                        Swal.fire('Error!', 'No record selected for deletion or the table is empty.', 'error');
                        return;
                    }

                    const form = document.getElementById('view-form');
                    form.action = form.action.replace(':id', recordId);
                    form.submit();
                }
            });
        }
        window.rejectRequest = rejectRequest;
    });

    document.getElementById('accept_button').addEventListener('click', function handleAccept(e) {
        e.preventDefault();
        document.getElementById('response_rejected_info').style.display = 'none';
        document.getElementById('response_accepted_info').style.display = 'block';

        function acceptRequest(id = null) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const recordId = id || document.getElementById('view_ids').value;

                    if (!recordId || recordId.trim() === '') {
                        Swal.fire('Error!', 'No record selected for deletion or the table is empty.', 'error');
                        return;
                    }

                    const form = document.getElementById('update-forms');
                    form.action = form.action.replace(':id', recordId);
                    form.submit();
                }
            });
        }
        window.acceptRequest = acceptRequest;
    });
}
window.viewBorrowed = viewBorrowed;

function editBorrowed(borrowed) {

    document.getElementById('update-request-modal').style.display = 'block';

    function convertToDatetimeLocalFormat(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        // Ensure the format is YYYY-MM-DDTHH:mm
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-based
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    document.getElementById('update_name').value = borrowed.name || '';
    document.getElementById('update_address').value = borrowed.address || '';
    document.getElementById('update_equipment').value = borrowed.equipment || '';
    document.getElementById('update_quantity').value = borrowed.quantity || '';
    document.getElementById('customInputs').value = borrowed.equipment || '';
    document.getElementById('update_purpose').value = borrowed.purpose || '';
    document.getElementById('update_contact').value = borrowed.contact || '';
    document.getElementById('update_borrow_date').value = convertToDatetimeLocalFormat(borrowed['borrow-date']);
    document.getElementById('update_return_date').value = convertToDatetimeLocalFormat(borrowed['return-date']);

    if( document.getElementById('update_equipment').value === ""){
        document.getElementById('customInputs').style.display = 'block';
        document.getElementById('update_equipment').style.display = 'none';

    }
    const form = document.getElementById('update-form');
    if (form && borrowed.id) {
        form.action = `borrowed/update/${borrowed.id}`; // Update the endpoint dynamically
    }
}
window.editBorrowed = editBorrowed;

function confirmDelete(id) {
    Swal.fire({
        title: 'Return equipment?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Return',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `borrowed/deletes/${id}`;
        }
    });
}
window.confirmDelete = confirmDelete;

// Search Function with Data Count Update
function filterTable() {
    const input = document.getElementById('search');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('borrowedTable');
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

function closeUpdateWalkInRequestModal() {
    document.getElementById('update-request-modal').style.display = 'none';
}
window.closeUpdateWalkInRequestModal = closeUpdateWalkInRequestModal;

function closeRequestModal() {
    document.getElementById('view-request-modal').style.display = 'none';
}
window.closeRequestModal = closeRequestModal;

function closeModal() {
    document.getElementById('response_accepted_info').style.display = 'none';
    document.getElementById('response_rejected_info').style.display = 'none';
    document.getElementById('view_accepted_response').value = '';
    document.getElementById('view_rejected_response').value = '';
    acceptRequest(id=null);
    rejectRequest(id=null);
}
window.closeModal = closeModal;


function openWalkInRequestModal() {
    document.getElementById('walk-in-request-modal').style.display = 'block';
    document.getElementById('Fullname').focus();
}
window.openWalkInRequestModal = openWalkInRequestModal;

function closeWalkInRequestModal() {
    document.getElementById('walk-in-request-modal').style.display = 'none';
}
window.closeWalkInRequestModal = closeWalkInRequestModal;


//  -- String Function--//
document.getElementById('Fullname').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

//  !-- String Function--//

function toggleInput(select) {
    var customInput = document.getElementById("customInput");
    var equip = document.getElementById("equipment");
    if (select.value === "other") {
        customInput.style.display = "block";
        equip.style.display = "none";
        customInput.name = "equipment"; // Change name so it gets submitted
    } else {
        customInput.style.display = "none";
        equip.style.display = "block";
        customInput.name = "custom_input"; // Keep name different to avoid submission
    }
}
window.toggleInput = toggleInput;

function toggleInputs(select) {
    var customInput = document.getElementById("customInputs");
    var update_equip = document.getElementById("update_equipment");
    if (select.value === "other") {
        customInput.style.display = "block";
        update_equip.style.display = "none";
        customInput.name = "equipment"; // Change name so it gets submitted
    } else {
        customInput.style.display = "none";
        update_equip.style.display = "block";
        customInput.name = "custom_input"; // Keep name different to avoid submission
    }
}
window.toggleInputs = toggleInputs;
