function editAnnouncement(announcement) {
    console.log("Announcement Data:", announcement);

    // Show the update announcement modal
    document.getElementById('announcement-container-modal').style.display = 'block';

    // Update form fields with announcement data
    document.getElementById('title').textContent = announcement.title || '';
    document.getElementById('what').textContent = announcement.what || '';
    document.getElementById('when').textContent = announcement.when || '';
    document.getElementById('where').textContent = announcement.where || '';

    // Check if the field exists and safely handle 'otherInfo'
    const otherInfoField = document.getElementById('otherInfo');
    if (otherInfoField) {
        otherInfoField.innerHTML = announcement.otherInfo
            ? announcement.otherInfo.replace(/\n/g, '<br>') // Convert newlines to <br> for display
            : '';
    }
}

window.editAnnouncement = editAnnouncement;

function closeRequestModal() {
    document.getElementById('announcement-container-modal').style.display = 'none';
}
window.closeRequestModal = closeRequestModal;