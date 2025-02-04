<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/borrowedStyle.css'])
</head>

<body>
    <section class="content-container">
        <div class="header">
            <h2>Request Borrowed Equipment's List</h2>
        </div>
        <div class="equipment-table-container">
            <div class="sub-main">
                <div class="search-area">
                    <input type="search" id="search" name="'search" Placeholder="Search" onkeyup="filterTable()">
                    <span class="search-icon"><i class='bx bx-search'></i></span>
                </div>
                <div class="add-btn">
                    <button onclick="openWalkInRequestModal()">ADD+</button>
                </div>
            </div>
            <table id="borrowedTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>EQUIPMENTS</th>
                        <th>PURPOSE</th>
                        <th>DATE-REQUEST</th>
                        <th>STATUS</th>
                        <th>RESPONSE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowed as $borroweds)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$borroweds->name}}</td>
                            <td>{{$borroweds->equipment}}</td>
                            <td>{{$borroweds->purpose}}</td>
                            <td>{{$borroweds->updated_at}}</td>
                        
                            <td style="display:none;">{{$borroweds->status ?? '' }}</td>
                            
                            <td>
                                @if($borroweds->status)
                                    <span class="status-accepted">waiting to return</span>
                                @else
                                    <span class="status-notaccepted">waiting to process</span>
                                @endif
                            </td>
                            <td style="display:none;" >{{$borroweds->response}}</td>
                            <td>
                                @if($borroweds->response)
                                    <span class="status-notaccepted">{{$borroweds->response}}</span>
                                @else
                                    <span class="status-accepted">---------</span>
                                @endif
                            </td>
                            
                            <td>
                                @if($borroweds->status)
                                    <a href="#" onclick='confirmDelete({{ $borroweds->id}})' class="view-btns">
                                      ------
                                    </a>
                                @else
                                    <a href="#" onclick='editBorrowed(@json($borroweds))' class="edit-btns">
                                        EDIT
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr id="noDataRow" style="display: none;">
                            <td colspan="8" style="text-align: center;">No data found</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">no borrowed request available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div id="dataCount" style="text-align: right; margin-top: 10px; font-size: 14px;">
                <span id="countValue">{{ $borrowed->count() }} of {{ $borrowed->count() }}</span>
            </div>
        </div>
    </section>

    @include('resident.borrowed.createBorrowed')

    @include('resident.borrowed.updateBorrowed')

</body>

</html>
@vite(['resources/js/borrowed.js'])