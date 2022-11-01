@extends('index');
@section('navbar')
<li class="nav-item">
    <a class="nav-link active" href="#">
        <i class="fas fa-tachometer-alt"></i>
        Főoldal
        <span class="sr-only">(current)</span>
    </a>
</li>
<li class="nav-item dropdown">

    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="far fa-file-alt"></i>
        <span>
            Reports <i class="fas fa-angle-down"></i>
        </span>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Daily Report</a>
        <a class="dropdown-item" href="#">Weekly Report</a>
        <a class="dropdown-item" href="#">Yearly Report</a>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="products.html">
        <i class="fas fa-shopping-cart"></i>
        Products
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="accounts.html">
        <i class="far fa-user"></i>
        Accounts
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-cog"></i>
        <span>
            Settings <i class="fas fa-angle-down"></i>
        </span>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Profile</a>
        <a class="dropdown-item" href="#">Billing</a>
        <a class="dropdown-item" href="#">Customize</a>
    </div>
</li>
@endsection
@section('content')


@endsection
