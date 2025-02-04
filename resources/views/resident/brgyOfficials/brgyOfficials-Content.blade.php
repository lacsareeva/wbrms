<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/ResidentStyles/brgyOfficials.css'])
    @vite(['resources/js/ResidentAndOfficials.js'])
</head>

<body>
    <section class="content-container">
        <div class="navbarss">
            <h2>About US</h2>
        </div>
        <div class="full-container">

            <div id="officialsContainer" class="container">
                <div class="header">
                    BRGY 216 OFFICIALS
                </div>
                <div class="officials-container">
                    @forelse($officialsinfo as $officialsinfos)
                        <div class="official-card">
                            <img src="{{ asset('storage/' . $officialsinfos->officialsimage) }}"
                                alt="{{ $officialsinfos->fullname }}" class="official-image">
                            <p class="position">

                                {{ $officialsinfos->position }}
                            </p>
                            <p class="names">
                                {{ $officialsinfos->fullname }}
                            </p>
                        </div>
                    @empty
                        <p>No officials found.</p>
                    @endforelse
                </div>
            </div>
    </section>
</body>

</html>