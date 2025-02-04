<div id="announcement-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAnnouncementForm()">&times;</span>
        <h2>Announcement Information</h2>
        <form method="POST" action="{{ route('admin.announcement.save') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-section">
                <label for="title">TITLE</label>
                <input type="text" id="title" name="title" required autofocus autocomplete="title">
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="form-section">
                <label for="what">WHAT</label>
                <textarea id="what" name="what" required></textarea>
            </div>
            <div class="form-section">
                <label for="when">WHEN</label>
                <input type="text" id="when" name="when" required>
            </div>
            <div class="form-section">
                <label for="where">WHERE</label>
                <input type="text" id="where" name="where" required>
            </div>
            <div class="form-section">
                <label for="other-info">OTHER INFO:(REQUIREMENT)</label>
                <textarea type="text" id="other-info" name="otherInfo" required></textarea>
            </div>
            <div class="form-section">
                <div class="button">
                    <button type="submit" class="post-btn">Post</button>
                </div>
            </div>
        </form>
    </div>
    @if (Session::has('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                text: "{{ e(Session::get('success')) }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
</div>