<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/AnnouncmentStyle.css'])
</head>

<body>
    <section class="content-container">
        <div class="header">
            <h2>Announcement</h2>
        </div>
        <form class='main-table-container' action="">
            <div class="table-container">
                <div class="sub-main">
                    <div class="search-area">
                        <input type="search" id="search" name="'search" Placeholder="Search" onkeyup="filterTable()">
                        <span class="search-icon"><i class='bx bx-search'></i></span>
                    </div>
                    <button type="button" class="Addbutton" onclick="openAnnouncementForm()">ADD +</button>
                </div>
                <table id="announcementTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>TITLE</th>
                            <th>DATE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($announcements as $announcement)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$announcement->title}}</td>
                                <td>{{$announcement->when}}</td>
                                <td style="padding:10px;">
                                    <a href="#" onclick='editAnnouncement(@json($announcement))' class="post-btns">
                                        EDIT
                                    </a>
                                    <a href="#" onclick="confirmDelete({{ $announcement->id}})" class="delete-btns">
                                       DELETE
                                    </a>
                                </td>
                            </tr>
                            <tr id="noDataRow" style="display: none;">
                                <td colspan="6" style="text-align: center;">No data found</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">annoouncement not found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="dataCount" style="text-align: right; margin-top: 10px; font-size: 14px;">
                    <span id="countValue">{{ $announcements->count() }} of {{ $announcements->count() }}</span>
                </div>
            </div>
        </form>

        <!-- add content section -->
        @include('admin.announcement.createAnnouncement')

        <!-- update content section -->
        @include('admin.announcement.updateAnnouncement')

    </section>
</body>
</html>
@vite(['resources/js/Announcement.js'])