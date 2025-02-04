<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="main-content">
        <div class="time-display">
            <div id="datetime"></div>
        </div>
        <div class="stats">
            <div class="stat-box">
                <p><a href="{{ route('admin.residentofficials.residentofficials') }}">Total No. of Residents</a></p>
                <h2>
                    <span id="countValue">{{ $users->count() }}</span>
                </h2>
            </div>
            <div class="stat-box">
                <p> <a href="{{ route('admin.records.records') }}">No. of Document Request's</a></p>
                <h2>
                    <span id="countValue">{{ $records->count() }}</span>
                </h2>
            </div>
            <div class="stat-box">
                <p><a href="{{ route('admin.blotter.blotter') }}">No. of Blotter Records</a></p>
                <h2>
                    <span id="countValue">{{ $blotter->count() }}</span>
                </h2>
            </div>
            <div class="stat-box">
                <p><a href="{{ route('admin.borrowed.borrowed') }}">Total Equipment Request's</a></p>
                <h2>
                    <span id="countValue">{{ $borrowed->count() }}</span>
                </h2>
            </div>
        </div>
    </div>
    </div>
</body>

</html>