<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/ResidentStyles/AnnouncementStyles.css'])

</head>

<body>
    <section class="content-container">
        <div class="header">
            <h2>WELCOME TO BAGONG BARANGAY <br> 216, ZONE 20 E-PORTAL </h2>
        </div>
        <div class="time-display">
            <div id="datetime"></div>
        </div>
        <div class="table-container">
            <div class="headers">
                <h2>ANNOUNCEMENT</h2>
            </div>
            <div class="announcement-content">
                @forelse($announcements as $announcement)

                    <div><span class="announcementTitle">{{$announcement->title}}</span>
                        <span class="announcementBtns">
                            <a href="#" onclick='editAnnouncement(@json($announcement))' class="post-btns">
                                <i class='bx bx-chevron-right'></i>
                            </a>
                        </span>
                    </div>
                @empty
                    <div>
                        annoouncement not found
                    </div>
                @endforelse
            </div>
        </div>
    </section>


    <section id="announcement-container-modal" style="display:none;">
        <div class="modal-content">
            <form id="view-form" method="POST">
                @csrf
                <span class="close" onclick="closeRequestModal()">&times;</span>
                <h2>
                    <p><strong id="title"></strong></p>
                </h2>
                <hr class="hr">
                <p><strong>WHAT: </strong> <span id="what"></span></p>
                <p><strong>WHEN: </strong> <span id="when"></span></p>
                <p><strong>WHERE: </strong> <span id="where"></span></p>
                <p><strong>OTHER INFORMATION (REQUIREMENT):</strong><br><div class="info" id="otherInfo"></div></p>
            </form>
        </div>
    </section>

</body>

</html>
@vite(['resources/js/ResidentScripts/announcementScripts.js'])