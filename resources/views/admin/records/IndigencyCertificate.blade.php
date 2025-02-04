<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Certificate of Indigency</title>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Arial', sans-serif;
            box-sizing: border-box;
        }

        body {
            background-image: url('{{ public_path('storage/image/INDIGENCY.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden;
        }

        .certificate-body {
            /* Center text content */
            margin-left: 190px;
            width: 58%;
            padding: 15%;
            padding-top: 37%;
            font-size: 4.0mm;
            line-height: 1.6;
        }

        footer p{
            text-indent: 20px;
        }

        .blocks {
            border-bottom: 1px solid black;
        }

        .body-text p {
            text-indent: 20px;
            font-size: 4.0mm;
            margin: 0;
            line-height: 1.5;
        }

        .signature {
            width: 30mm;
            display: block;
            margin: 5mm auto;
        }
    </style>

</head>

<body>
    <div class="certificate">
        <header>
            <div class="logos"></div>
            <div class="header-text"></div>
        </header>
        <div class="certificate">
            <div class="certificate-body">
                <div class="body-text">
                    <strong>TO WHOM IT MAY CONCERN,</strong>
                    <p> This is to certify that
                        <strong class="blocks">{{ $fullname }}, {{ $age }} </strong>
                        years old, with a postal address at
                        <strong class="blocks">{{ $address }}</strong>,
                        Tondo, Manila, is a bonafide resident of Barangay 216, Zone 20.
                    </p>
                    <br>
                    <p>
                        This is to certify further that the abovementioned name and
                        his/her family is classified as <strong>“INDIGENT”</strong> in this barangay.
                    </p>

                    <br>
                    <p> This certification is being issued upon request for </p><strong
                        class="blocks">{{ $purpose }} </strong> and for whatever legal purpose it may serve him/her
                    best.
                    </p>
                </div>
                <footer>
                    <p>
                        <strong>IN WITNESS WHERE OF</strong>, I have her unto set my hand and affixed
                        the official seal of this office. Done in the Office of Barangay Chairman,
                        Brgy. 216, Zone 20, City of Manila this
                        <strong class="blocks">{{ $day }}</strong> day of
                        <strong class="blocks">{{ $month }}</strong> year
                        <strong class="blocks">{{ $year }}</strong>.
                    </p>
                    <div class="signature-block"></div>
                </footer>
            </div>
        </div>
    </div>
</body>

</html>