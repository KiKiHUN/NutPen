<?php

namespace App\Http\Controllers;

use App\Models\Diak;
use App\Models\Szulo;
use App\Models\Tanar;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ElvalasztoController extends Controller
{
   public function Dash()
   {
    $azonositoValaszto = mb_substr(Auth::user()->azonosito, 0, 1);
    switch ($azonositoValaszto) {
        case 'd':
            $user = Diak::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('diak.diak_dashboard',['user'=>$user]);
            break;
        case 's':
            $user = Szulo::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('szulo.szulo_dashboard',['user'=>$user]);
            break;
        case 't':
            $user = Tanar::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('tanar.tanar_dashboard',['user'=>$user]);
            break;
    }
   }
   public function fiok()
   {
    $azonositoValaszto = mb_substr(Auth::user()->azonosito, 0, 1);

    switch ($azonositoValaszto) {
        case 'd':
            $user = Diak::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('diak.fiok',['user'=>$user]);
            break;
        case 's':
            $user = Szulo::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('szulo.fiok',['user'=>$user]);
            break;
        case 't':
            $user = Tanar::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('tanar.fiok',['user'=>$user]);
            break;
    }
   }
   public function hianyzas()
   {
    $azonositoValaszto = mb_substr(Auth::user()->azonosito, 0, 1);

    switch ($azonositoValaszto) {
        case 'd':
            $user = Diak::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('diak.hianyzas',['user'=>$user]);
            break;
        case 's':
            $user = Szulo::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('szulo.hianyzas',['user'=>$user]);
            break;
        case 't':
            $user = Tanar::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('tanar.hianyzas',['user'=>$user]);
            break;
    }
   }
   public function ora()
   {
    $azonositoValaszto = mb_substr(Auth::user()->azonosito, 0, 1);

    switch ($azonositoValaszto) {
        case 'd':
            $user = Diak::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('diak.ora',['user'=>$user]);
            break;
        case 's':
            $user = Szulo::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('szulo.ora',['user'=>$user]);
            break;
        case 't':
            $user = Tanar::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('tanar.ora',['user'=>$user]);
            break;
    }
   }
   public function ertekeles()
   {
    $azonositoValaszto = mb_substr(Auth::user()->azonosito, 0, 1);

    switch ($azonositoValaszto) {
        case 'd':
            $ertekelesek=DB::table('ertekeles')->join('diaks', function ($join) {
                $join->on('diaks.azonosito', '=', 'ertekeles.Diak_azonosito')->where('Diak_azonosito', '=', Auth::user()->azonosito);
        })->orderBy('datum','desc')->get();

            return View('diak.ertekeles',['ertekelesek'=>$ertekelesek]);
            break;
        case 's':

            $gyerekek=DB::table('diaks_szulos')->where('Szulo_azonosito', '=', Auth::user()->azonosito)->get();
            return View('szulo.ertekeles',['gyerekek'=>$gyerekek]);
            break;
        case 't':
            $user = Tanar::where(['azonosito' => Auth::user()->azonosito])->first();
            return View('tanar.ertekeles',['user'=>$user]);
            break;
    }
   }
}
