import './bootstrap';

// open-close funtions
function openAnnouncementForm() {
    document.getElementById('announcement-modal').style.display = 'block';
    document.getElementById('title').focus();
}
window.openAnnouncementForm = openAnnouncementForm;

function closeAnnouncementForm() {
    document.getElementById('announcement-modal').style.display = 'none';
}
window.closeAnnouncementForm = closeAnnouncementForm;
// -------------------------

// Update Announcement Form
function editAnnouncement(announcement) {
    console.log("Announcement Data:", announcement);

    document.getElementById('update-announcement-modal').style.display = 'block';

    document.getElementById('update_title').value = announcement.title || '';
    document.getElementById('update_what').value = announcement.what || '';
    document.getElementById('update_when').value = announcement.when || '';
    document.getElementById('update_where').value = announcement.where || '';
    const otherInfoField = document.getElementById('update_other_info');
    if (otherInfoField) {
        console.log("otherInfo:", announcement.otherInfo);
        otherInfoField.value = announcement.otherInfo || '';
    }

    const form = document.getElementById('update-form');
    if (form) {
        form.action = `announcement/update/${announcement.id}`;
    }
}

window.editAnnouncement = editAnnouncement;

function closeModals() {
    document.getElementById('update-announcement-modal').style.display = 'none';
}
window.closeModals = closeModals;

// ---------------------------------------

// Delete Announcement Function
function confirmDelete(id) {
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
            window.location.href = `announcement/delete/${id}`;
        }
    });
}
window.confirmDelete = confirmDelete;
// ---------------------------------------

// Search Function with Data Count Update
function filterTable() {
    const input = document.getElementById('search');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('announcementTable');
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