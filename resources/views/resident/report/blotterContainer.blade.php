<div id="blotterContainer" class="container" style="display: none;">

    <div>
        <div>
            <h2>BLOTTER HISTORY</h2>
        </div>
    </div>

    <table id="blotterTable">
        <thead>
            <tr>
                <th>#</th>
                <th>NAME OF COMPLAINANT</th>
                <th>DATE FILE</th>
                <th>INCIDENT REPORT</th>
                <th>DATE-END</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($archivedBlotter as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nameofcomplainant}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->incident_report}}</td>
                    <td>{{$item->settled_at ?? '------' }}</td>
                    <td class="blotter-status">
                        @if($item->settled_at)
                            <span class="status-settled">SETTLED</span>
                        @else
                            <span class="status-unsettled">UNSETTLED</span>
                        @endif
                    </td>
                </tr>
                <tr id="noDataRow" style="display: none;">
                    <td colspan="6" style="text-align: center;">No data found</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">no blottered History</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div id="dataCount" style="text-align: right; margin-top: 10px; font-size: 14px;">
        <span id="countValuess">{{ $archivedBlotter->count() }} of {{ $archivedBlotter->count() }}</span>
    </div>
</div>