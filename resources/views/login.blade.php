@extends('layout')

@section('navbar')

<li class="nav-item">
    <a class="nav-link active" href="accounts.html">
        <i class="far fa-user"></i>
        Accounts
        <span class="sr-only">(current)</span>
    </a>
</li>

@endsection

    @section('content')

<div class="tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-12 mx-auto tm-login-col">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12 text-center">
                <h2 class="tm-block-title mb-4">Üdvözöljük a NutPen naplóban</h2>
                <h2 class="tm-block-title mb-4">Kérem jelentkezzen be</h2>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form action="/logincheck" method="post" class="tm-login-form">
                    @csrf
                  <div class="form-group">
                    <label for="username">Azonosító</label>
                    <input
                      name="azonosito"
                      type="text"
                      class="form-control validate"
                      id="azonosito"
                      value=""
                      required
                    />
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Jelszó</label>
                    <input
                      name="jelszo"
                      type="password"
                      class="form-control validate"
                      id="jelszo"
                      value=""
                      required
                    />
                  </div>
                  <div class="form-group mt-4">
                    <button
                      type="submit"
                      class="btn btn-primary btn-block text-uppercase"
                    >
                      Bejelentkez
                    </button>
                    @if ($voltProba==true)
                        <br>
                        <h2 style="color: red">Sikertelen bejelentkezés</h2>
                    @endif

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
      @endsection
