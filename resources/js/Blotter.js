// Delete Function
function submitDeleteForm(id = null) {
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
            const recordId = id || document.getElementById('view_id')?.innerText;

            if (!recordId || recordId.trim() === '') {
                Swal.fire('Error!', 'No record selected for deletion or the table is empty.', 'error');
                return;
            }
            const form = document.getElementById('delete-form');
            form.addEventListener('submit', (event) => {
                event.preventDefault();
            });

            form.action = form.action.replace(':id', recordId);
            setTimeout(() => {
                form.removeEventListener('submit', (event) => {
                    event.preventDefault();
                });
                form.submit();
            }, 500);
        } 
    });
}
window.submitDeleteForm = submitDeleteForm;
// --------------------

// Edit Function

function editBlotter(blotter) {
    document.getElementById('update-walk-in-modal').style.display = 'block';
    document.getElementById('update_incident_report').value = blotter.incident_report || '';
    document.getElementById('update_address').value = blotter.address || '';
    document.getElementById('update_date_time').value = blotter.datetimes || '';
    document.getElementById('update_complainant_name').value = blotter.nameofcomplainant || '';
    document.getElementById('update_witness1').value = blotter.witness1 || '';
    document.getElementById('update_witness2').value = blotter.witness2 || '';
  
    const otherInfoField = document.getElementById('update_narrative');
    if (otherInfoField) {
        otherInfoField.value = blotter.narrative || '';
    }

    document.getElementById('update_sender').value = blotter.sender || '';
    const form = document.getElementById('update-form');
    if (form) {
        form.action = `blotter/update/${blotter.id}`;
    }
}

window.editBlotter = editBlotter;
// --------------------

// View Function
function viewBlotter(blotter) {
    document.getElementById('view-walk-in-modal').style.display = 'block';

    document.getElementById('view_id').textContent = blotter.id || '';
    document.getElementById('view_incident_report').textContent = blotter.incident_report || '';
    document.getElementById('view_address').textContent = blotter.address || '';
    document.getElementById('view_date_time').textContent = blotter.datetimes || '';
    document.getElementById('view_complainant_name').textContent = blotter.nameofcomplainant || '';
    document.getElementById('view_witness1').textContent = blotter.witness1 || '';
    document.getElementById('view_witness2').textContent = blotter.witness2 || '';
  
    const otherInfoField = document.getElementById('view_narrative');
    if (otherInfoField) {
        otherInfoField.textContent = blotter.narrative || '';
    }

    document.getElementById('view_sender').textContent = blotter.sender || '';
    const form = document.getElementById('view-form');
    if (form) {
        form.action = `blotter/update/${blotter.id}`;
    }
}

window.viewBlotter = viewBlotter;
// --------------------

// open/close funtion
function openWalkInModal() {
    document.getElementById('walk-in-modal').style.display = 'block';
    document.getElementById('incident-report').focus();
}
window.openWalkInModal = openWalkInModal;

function closeWalkInModal() {
    document.getElementById('walk-in-modal').style.display = 'none';
}
window.closeWalkInModal = closeWalkInModal;

function closeUpdateWalkInModal() {
    document.getElementById('update-walk-in-modal').style.display = 'none';
}
window.closeUpdateWalkInModal = closeUpdateWalkInModal;

function closeViewWalkInModal() {
    document.getElementById('view-walk-in-modal').style.display = 'none';
}
window.closeViewWalkInModal = closeViewWalkInModal;
// --------------------

// Search Function with Data Count Update
function filterTable() {
    const input = document.getElementById('search');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('blotterTable');
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
//--------------------------------------

//  -- String Function--//
document.getElementById('complainant-name').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

document.getElementById('witness1').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

document.getElementById('witness2').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});
//  !-- String Function--//
