<div id="borrowContainer" class="container" style="display: none;">

    <div>
        <div>
            <h2>BORROWED EQUIPMENT HISTORY</h2>
        </div>
    </div>

    <table id="borrowTable">
        <thead>
            <tr>
                <th>#</th>
                <th>FULLNAME</th>
                <th>EQUIPMENT</th>
                <th>DATE-REQUEST</th>
                <th>DATE-RETURNED</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($archivedBorrowed as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->equipment }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->returned_at ?? '--------' }}</td>
                    <td>
                        @if($item->status === 'rejected') <!-- Use strict comparison (===) -->
                            <span class="status-notaccepted">Rejected</span>
                        @elseif($item->status === 'returned')
                            <span class="status-return">Returned</span>
                        @elseif($item->status === 'Accepted')
                            <span class="status-accepted">Waiting to return(accepted)</span>
                        @else
                            <span class="status-waiting">Waiting to process</span>
                        @endif
                    </td>
                </tr>
                <tr id="noDataRow" style="display: none;">
                    <td colspan="7" style="text-align: center;">No data found</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No borrowed history</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div id="dataCount" style="text-align: right; margin-top: 10px; font-size: 14px;">
        <span id="countValue">{{ $archivedBorrowed->count() }} of {{ $archivedBorrowed->count() }}</span>
    </div>

</div>