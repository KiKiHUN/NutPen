<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ElvalasztoController extends Controller
{
   public function Dash()
   {
    $azonositoValaszto = mb_substr(Auth::user()->azonosito, 0, 1);
    switch ($azonositoValaszto) {
        case 'd':
            return View('diak_dashboard');
            break;
        case 's':
            return View('szulo_dashboard');
            break;
        case 't':
            return View('tanar_dashboard');
            break;
    }
   }
}
