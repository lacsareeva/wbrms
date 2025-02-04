<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Business Permit</title>

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
            background-image: url('{{ public_path('storage/image/BUSINESSPERMIT.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden;
        }

        footer p {
            text-indent: 20px;
        }

        .certificate-body {
            margin-left: 190px;
            width: 58%;
            padding: 15%;
            padding-top: 37%;
            font-size: 4.0mm;
            line-height: 1.6;
        }

        .blocks {
            border-bottom: 1px solid black;
        }

        .body-text p {
            font-size: 4.0mm;
            margin: 0;
            line-height: 1.5;
            text-indent: 20px;
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
                    <p>
                        This is to certify that the Business of firm registered, this
                        office is hereby garanted a barangay Clearance to operate the Business , which is within the
                        territorial; jurisdiction of Barangay 216 Zone 20, District II of the City of Manila in pursuant
                        to the provisions of SECTION 216 (c) R.A no. 7160 otherwise known as the Local Government Code
                        of 1991
                    </p>
                    <br>
                    <p style="margin-left:20px; font-size: 4.0mm;">
                        <strong>BUSINESS NAME: {{ $requirement }}</strong>
                    </p>

                    <p style="margin-left:20px; font-size: 4.0mm;">
                        <strong>REGISTERED OWNER: {{ $fullname }} </strong>
                    </p>

                    <p style="margin-left:20px; font-size: 4.0mm;">
                        <strong>BUSINESS ADDRESS: {{ $address }}</strong>
                    </p>
                </div>

                <footer>
                    <p>
                        This Barangay Permit is hereby issued upon the request of the
                        said owner, proprietor of the said establishment whose signature appears under.<br>
                    </p>
                    <p>
                        Given this
                        <strong class="blocks">{{ $day }}</strong> day of
                        <strong class="blocks">{{ $month }}</strong> year
                        <strong class="blocks">{{ $year }}</strong>.
                    </p>

                    <br><br>
                    <!-- signature -->
                    <hr style="border: 0; border-bottom: 1px solid black; width: 50%; margin-left: 5%;">
                    <p style="text-align: center; margin-right:45%;"><strong>Owner/Proprietor</strong></p>
                    </p>
                    <div class="signature-block"> </div>
                </footer>
            </div>
        </div>
    </div>
</body>

</html>