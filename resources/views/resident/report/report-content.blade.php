<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/reportStyles.css'])
</head>

<body>
    <section class="content-container">
        <div class="header">
            <h2 style="text-align:left;">History</h2>
        </div>
        <div class="navbarss">
            <div class="search-area">
                <div class="search-container">
                    <span class="search-icon"><i class='bx bx-search'></i></span>
                    <input type="search" id="search" name="search" placeholder="Search" onkeyup="filterTable()">
                    <button class="searchbtn" onclick="searchReport()"><i class='bx bx-search-alt-2'></i></button>
                </div>
            </div>

            <div class="report-btn">
                <button id="requestBtn" class="active" onclick="showSection('requestContainer')">Request's list</button>
                <button id="borrowBtn" onclick="showSection('borrowContainer')">Borrow's list</button>
                <button id="blotterBtn" onclick="showSection('blotterContainer')">Blotter's list</button>
            </div>
        </div>
        <div class="full-container">

            <!-- request table content -->
            @include('resident.report.requestContainer')

            <!-- borrow table content -->
            @include('resident.report.borrowContainer')

            <!-- blotter table content -->
            @include('resident.report.blotterContainer')

        </div>
    </section>
</body>

</html>

@vite(['resources/js/ResidentScripts/reportScripts.js'])