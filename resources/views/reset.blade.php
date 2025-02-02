@extends('layout')

@section('navbar')
    <li class="nav-item">
        <a class="nav-link" href="/Dashboard">
            <i class="fa-solid fa-house-chimney"></i>
            Főoldal
            <span class="sr-only">(current)</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/ertekeles">
            <i class="fa-solid fa-cross"></i>
            Értékelések
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/ora">
            <i class="fa-solid fa-clock"></i>
            Órarend
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/hianyzas">
            <i class="fa-solid fa-person-circle-question"></i>
            Hiányzások
        </a>
    </li>


    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
            <span>
                Beállítások <i class="fas fa-angle-down"></i>
            </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/fiok">Fiók</a>
            <a class="dropdown-item" href="/logout">Kilépés</a>
        </div>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <br>
        </div>
    </div>
    <!-- row -->
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
            <div class="tm-bg-primary-dark tm-block">
                <div class="kozepre">
                    <p id="hiba" style="color: red"></p>
                    <form action="/pwreset/save " id="formkuld" class="kozepform" method="post">
                        @csrf
                        <p class="text-white mt-5 mb-5">Azonsoító: <b>{{ $azonosito }}</b></p>
                        <p class="text-white">Új jelszó:</b></p>
                        <input type="password" name="jelszo1" id="jelszo1">
                        <br>
                        <br>
                        <p class="text-white ">Új jelszó ismét:</b></p>
                        <input type="password" id="jelszo2">
                        <br>
                        <br>
                        <input type="submit" class="btn btn-success " value="Jelszó módosítása">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        document.getElementById('formkuld').onsubmit = function() {
            if (document.getElementById('jelszo1').value == document.getElementById('jelszo2').value) {
                if (document.getElementById('jelszo1').value.length < 8) {
                    document.getElementById('hiba').innerText = "Legalább 8 karaktenek kell lennie";
                    return false;
                } else {
                    return true;
                }
            } else {
                document.getElementById('hiba').innerText = "A két jelszó nem egyezik meg.";
                return false;
            }
            return false;
        };
    </script>
@endsection
