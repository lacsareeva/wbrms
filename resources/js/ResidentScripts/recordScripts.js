// Open Add Document Function
function openAddDialog() {
    const addDialog = document.getElementById('add-dialog');
    const addDialogMobile = document.getElementById('add-dialog-mobile');

    if (window.innerWidth <= 785) {
        addDialogMobile.style.display = 'block';
    } else if (window.innerWidth >= 786) {
        addDialog.style.display = 'block';
    }
}
window.openAddDialog = openAddDialog;

// Close Add Document Function
function closeWalkInRequestModal() {
    document.getElementById('add-dialog').style.display = 'none';
}
window.closeWalkInRequestModal = closeWalkInRequestModal;

function closeWalkInRequestModals() {
    document.getElementById('add-dialog-mobile').style.display = 'none';
}
window.closeWalkInRequestModals = closeWalkInRequestModals;

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
            form.action = `record/update/${record.id}`;
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
            form.action = `record/update/${record.id}`;
        }
    }

    else if (requestType === 'Request for Business Permit') {

        document.getElementById('view-update-BP-Request-modal').style.display = 'block';

        document.getElementById('update_requirement').value = record.requirement || '';
        document.getElementById('update_fullnames').value = record.fullname || '';
        document.getElementById('update_addresss').value = record.address || '';

        const form = document.getElementById('update-bp-form');
        if (form && record.id) {
            form.action = `record/update/${record.id}`;
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