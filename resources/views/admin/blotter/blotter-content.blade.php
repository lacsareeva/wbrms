<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/blotterStyles.css'])
</head>

<body>
    <section class="content-container">
        <div class="header">
            <h2>Blotter Report</h2>
        </div>
        <div class="blotter-table-container">
            <div class="sub-main">
                <div class="search-area">
                    <input type="search" id="search" name="'search" Placeholder="Search" onkeyup="filterTable()">
                    <span class="search-icon"><i class='bx bx-search'></i></span>
                </div>
                <div class="add-btn">
                    <button onclick="openWalkInModal()">ADD+</button>
                </div>
            </div>
            <table id="blotterTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NAME OF COMPLAINANT</th>
                        <th>DATE FILE</th>
                        <th>INCIDENT REPORT</th>
                        <th>DATE-TIME HAPPEN</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blotter as $blotters)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$blotters->nameofcomplainant}}</td>
                            <td>{{$blotters->created_at}}</td>
                            <td>{{$blotters->incident_report}}</td>
                            <td>{{$blotters->datetimes}}</td>
                            <td>
                                <a href="#" onclick='viewBlotter(@json($blotters))' class="view-btn">
                                    VIEW
                                </a>
                                <a href="#" onclick='editBlotter(@json($blotters))' class="edit-btn">
                                    EDIT
                                </a>
                            </td>
                        </tr>
                        <tr id="noDataRow" style="display: none;">
                            <td colspan="6" style="text-align: center;">No data found</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">no blotter report available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div id="dataCount" style="text-align: right; margin-top: 10px; font-size: 14px;">
                <span id="countValue">{{ $blotter->count() }} of {{ $blotter->count() }}</span>
            </div>
        </div>

        @include('admin.blotter.createBlotter')

        @include('admin.blotter.updateBlotter')

        @include('admin.blotter.viewBlotter')

    </section>
</body>

</html>
@vite(['resources/js/Blotter.js'])