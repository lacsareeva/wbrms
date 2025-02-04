<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/account.css'])
</head>

<body>

    <section class="content-container">
        <div class="header">
            <h2>List of Accounts</h2>
        </div>
        <div class="accounts-container">
            <form class='main-table-container' action="">
                <div class="table-container">
                    <button type="button" class="Addbutton" onclick="openAddAccountModal()">ADD +</button>
                    <table id="announcementTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }} {{ $admin->mname }} {{ $admin->lname }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td style="padding:10px;">
                                        <a href="#" onclick='openEditModal(@json($admin))' class="post-btns">
                                            EDIT
                                        </a>
                                        <button type="button" class="delete-btns" onclick="confirmRemove({{$admin->id}})">
                                            REMOVE
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align:center;">No announcements found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div id="dataCount" style="text-align: right; margin-top: 10px; font-size: 14px;">
                        <span id="countValue">{{ $admins->count() }} of {{ $admins->count() }}</span>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @include('admin.accounts.updateAccounts')

    @include('admin.accounts.createAccounts')

</body>

</html>
@vite(['resources/js/account.js'])