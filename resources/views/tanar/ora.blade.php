@extends('layout')

@section('navbar')
    <li class="nav-item">
        <a class="nav-link" href="/Dashboard">
            <i class="fa-solid fa-house-chimney"></i>
            Főoldal
            <span class="sr-only">(current)</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa-solid fa-circle-check"></i>
            <span>
                Értékelés <i class="fas fa-angle-down"></i>
            </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/ertekeles">Listázás</a>
            <a class="dropdown-item" href="/ertekeles/tantargyvalaszt">Új</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa-solid fa-clock"></i>
            <span>
                Órák <i class="fas fa-angle-down"></i>
            </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/ora">Órarend</a>
        </div>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa-solid fa-circle-check"></i>
            <span>
                Hiányzás/késés <i class="fas fa-angle-down"></i>
            </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/hianyzas">Listázás</a>
            <a class="dropdown-item" href="/hianyzas/tantargyvalaszt">Új</a>
        </div>
    </li>


    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
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
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
            <br>
        </div>
        <div class="col-12 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                <h2 class="tm-block-title">Órarend megtekintése</h2>
                <table id='dtBasicExample' class="table table-bordered table-striped table-sm ">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Hétfő</th>
                            <th>Kedd</th>
                            <th>Szerda</th>
                            <th>Csütörtök</th>
                            <th>Péntek</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach ($targyak as $item)
                            <tr>
                                <th>08:00-08:45</th>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                            </tr>
                            <tr>
                                <th>09:00-09:45</th>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                            </tr>
                            <tr>
                                <th>09:55-10:40</th>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                            </tr>
                            <tr>
                                <th>10:50-11:35</th>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                            </tr>
                            <tr>
                                <th>12:00-12:45</th>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                            </tr>
                            <tr>
                                <th>12:55-13:40</th>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                            </tr>
                            <tr>
                                <th>13:55-14:40</th>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                                <td>{{ $item->nev }}</td>
                            </tr>
                        @endforeach
                    </tbody>
            </div>
        </div>
    </div>
    </div>
@endsection
