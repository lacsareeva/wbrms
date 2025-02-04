<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/recordStyles.css'])
</head>

<body>
    <section class="content-container">
        <div class="header">
            <h2>Request Document</h2>
        </div>
        <div class="request-container">
            <div class="sub-main">
                <div class="search-area">
                    <input type="search" id="search" name="search" Placeholder="Search" onkeyup="filterTable()">
                    <span class="search-icon"><i class='bx bx-search'></i></span>
                </div>
                <div class="add-btn">
                    <button class="add-button" onclick="openAddDialog()">ADD +</button>
                </div>
            </div>
            <table id="recordTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>FULLNAME</th>
                        <th>DATE REQUEST</th>
                        <th>REQUEST TYPE</th>
                        <th>STATUS</th>
                        <th>RESPONSE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$record->fullname}}</td>
                            <td>{{$record->created_at}}</td>
                            <td>{{$record->requesttype}}</td>
                            <td style="display:none;">{{$record->status ?? '' }}</td>
                            <td>
                                @if($record->status === 'pending')
                                    <span class="status-pending">pending</span>
                                @elseif($record->status === 'accepted')
                                    <span class="status-notaccepted">accepted</span>
                                @endif
                            </td>
                            <td>
                                @if($record->status === 'pending')
                                    <span class="status-pending">wait for it to process</span>
                                @elseif($record->status === 'accepted')
                                    <span class="status-notaccepted">please pick up the document in the brgy hall</span>
                                @endif
                            </td>
                            <td style="padding:10px;">
                                @if($record->status === 'accepted')
                                    <a href="#" onclick="confirmDelete({{ $record->id}})" class="delete-btns">
                                    ------
                                    </a>
                                @else
                                    <a href="#" onclick='editRecord(@json($record))' class="edit-btn">
                                        EDIT
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr id="noDataRow" style="display: none;">
                            <td colspan="7" style="text-align: center;">No data found</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"> no request document available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div id="dataCount" style="text-align: right; font-size: 14px;">
                <span id="countValue">{{ $records->count() }} of {{ $records->count() }}</span>
            </div>

            @include('resident.record.createRecords')

            @include('resident.record.updateRecords')

    </section>
</body>

</html>

@vite(['resources/js/ResidentScripts/recordScripts.js'])