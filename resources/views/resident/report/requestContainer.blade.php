<div id="requestContainer" class="container">
    <div>
        <div>
            <h2>DOCUMENT REQUEST HISTORY</h2>
        </div>
    </div>
    <table id="requestTable">
        <thead>
            <tr>
                <th>#</th>
                <th>FULLNAME</th>
                <th>START OF REQUEST</th>
                <th>REQUEST TYPE</th>
                <th>RESPONSE</th>
                <th>END OF REQUEST</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($archivedRecords as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->fullname }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->requesttype }}</td>
                    <td>{{ $item->response }}</td>
                    <td>{{ $item->remove_at ?? '--------' }}</td>
                    <td>
                        @if($item->status === 'rejected')
                            <span class="status-notaccepted">rejected</span>
                        @elseif($item->status === 'received')
                            <span class="status-waiting">received</span>
                        @endif
                    </td>
                </tr>
                <tr id="noDataRow" style="display: none;">
                    <td colspan="7" style="text-align: center;">No data found</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No document history</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div id="dataCount1" style="text-align: right; margin-top: 10px; font-size: 14px;">
        <span id="countValue1">{{ $archivedRecords->count() }} of {{ $archivedRecords->count() }}</span>
    </div>
</div>