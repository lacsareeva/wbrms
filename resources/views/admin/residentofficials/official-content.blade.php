<div id="officialsContainer" class="container" style="display: none;">

    <div class="headerss">
        BRGY 216 OFFICIALS
    </div>

    <div class="officials-container">
        @forelse($officialsinfo as $officialsinfos)
            <div class="official-card">
                <img src="{{ asset('storage/' . $officialsinfos->officialsimage) }}" alt="{{ $officialsinfos->fullname }}"
                    class="official-image">
                <p class="position">
                    <input style="color:#16a085" type="text" name="position" value="{{ $officialsinfos->position }}"
                        readonly><br>
                </p>
                <p class="names">
                    <input style="font-weight:100;" type="text" name="fullname" value="{{ $officialsinfos->fullname }}"
                        readonly>
                </p>
                <button class="edit-button"
                    onclick="openOfficialsModal('{{ $officialsinfos->fullname }}', '{{ $officialsinfos->position }}', '{{ $officialsinfos->id }}','{{ asset('storage/' . $officialsinfos->officialsimage) }}')">
                    Edit
                </button>
            </div>
        @empty
            <p>No officials found.</p>
        @endforelse
    </div>

    <div class="overlay" id="overlay"></div>

    <!-- Edit Modal -->
</div>

<div id="editOfficialsModal" class="modal" style="display: none;">
    <div class="modal-contents">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit Official</h2>
        <form id="editForms" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" id="officialId">

            <label for="fullname">Full Name:</label>
            <input type="text" name="fullname" id="fullname" required>

            <label for="position">Position:</label>
            <input type="text" name="position" id="position" required>

            <div class="btn-data">
                <img id="officialsimages" src="" alt="Official Image" class="official-image">
                <label for="officialsimage" class="ofimage">Upload Photo</label>
                <input type="file" name="officialsimage" id="officialsimage" class="inputFile"
                    onchange="previewImage(event)">
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
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