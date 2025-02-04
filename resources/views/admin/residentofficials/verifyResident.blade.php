<div id="verificationContainer" class="container" style="display:none;">
    <div class="headerss">
        RESIDENTS VERIFICATION LIST
    </div>
    <form class='main-table-container' action="" enctype="multipart/form-data">
        @csrf
        <div class="table-container">
            <div class="sub-main">
                <div class="search-area">
                    <input type="search" id="searches" name="search" placeholder="Search" onkeyup="filterTables()">
                    <span class="search-icon"><i class='bx bx-search'></i></span>
                </div>
            </div>
            <table id="residentverifyTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>FULLNAME</th>
                        <th>EMAIL</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }} {{ $user->mname ?? '' }} {{ $user->lname }} {{ $user->suffix ?? '' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->verificationInfo}}</td>
                            <td style="padding:10px;">
                                <a href="#" onclick='viewResidents(@json($user))' class="view-btns">
                                    VIEW
                                </a>
                            </td>
                        </tr>
                        <tr id="noDataRow" style="display: none;">
                            <td colspan="7" style="text-align: center;">No data found</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">No residents found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div id="dataCount" style="text-align: right; margin-top: 10px; font-size: 14px;">
                <span id="countValuess">{{ $users->count() }} of {{ $users->count() }}</span>
            </div>
        </div>
    </form>
</div>

@include('admin.residentofficials.viewResident')
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