<div id="announcementContainer" class="container" style="display: none;">

    <div>
        <div>
            <h2>ANNOUNCEMENT HISTORY</h2>
        </div>
        <div class="print-button">
            <button id="toPDF">PRINT</button>
        </div>
    </div>

    <table id="announcementTable">
        <thead>
            <tr>
                <th>#</th>
                <th>TITLE</th>
                <th>START OF ANNOUNCEMENT</th>
                <th>END OF ANNOUNCEMENT</th>
            </tr>
        </thead>
        <tbody>
            @forelse($archivedAnnouncements as $archivedAnnouncement)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $archivedAnnouncement->title }}</td>
                    <td>{{ $archivedAnnouncement->created_at }}</td>
                    <td>{{ $archivedAnnouncement->deleted_at }}</td>
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
        <span id="countValues">{{ $archivedAnnouncements->count() }} of {{ $archivedAnnouncements->count() }}</span>
    </div>

</div>