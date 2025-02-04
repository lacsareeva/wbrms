<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/resident.css'])
    @vite(['resources/js/ResidentAndOfficials.js'])
</head>

<body>
    <section class="content-container">
        <div class="navbarss">
            <div class="report-btn">
                <button id="residentsBtn" class="active" onclick="showSection('residentsContainer')">Resident's
                    list</button>
                <button id="officialsBtn" onclick="showSection('officialsContainer')">Barangay Official's list</button>
                <button id="verifyBtn" onclick="showSection('verificationContainer')">Residents Verification's
                    list</button>

            </div>
        </div>
        <div class="full-container">

            <!-- resident content -->
            @include('admin.residentofficials.resident-content')

            <!-- official content -->
            @include('admin.residentofficials.official-content')

            <!-- Verification content -->
            @include('admin.residentofficials.verifyResident')

        </div>
    </section>
</body>
@if(session('message'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            text: "{{ e(session('message')) }}",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Validation Error!',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
