<div id="accountsContainer" class="container" style="display: none;">
    <div>
        <div>
            <h2>LIST OF ACCOUNTS</h2>
        </div>
        <div class="print-button">
            <button id="account_toPDF">PRINT</button>
        </div>
    </div>
    <table id="accountsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>FULLNAME</th>
                <th>START</th>
                <th>POSITION</th>
                <th>END</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($archivedAccounts as $archivedAccount)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$archivedAccount->name}} {{ $archivedAccount->mname }} {{ $archivedAccount->lname }}
                        {{ $archivedAccount->suffix }}</td>
                    <td>{{ $archivedAccount->created_at }}</td>
                    <td>{{ $archivedAccount->usertype }}</td>
                    <td>{{ $archivedAccount->remove_at ?? '------' }}</td>
                    <td class="account-status">
                        @if($archivedAccount->remove_at)
                            <span class="status-settled">INACTIVE</span>
                        @else
                            <span class="status-unsettled">ACTIVE</span>
                        @endif
                    </td>
                </tr>
                <tr id="noDataRow" style="display: none;">
                    <td colspan="6" style="text-align: center;">No data found</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">No announcements found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div id="dataCounts" style="text-align: right; margin-top: 10px; font-size: 14px;">
        <span id="countValues">{{ $archivedAccounts->count() }} of {{ $archivedAccounts->count() }}</span>
    </div>

</div>