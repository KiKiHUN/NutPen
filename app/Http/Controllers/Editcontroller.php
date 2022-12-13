<?php

namespace App\Http\Controllers;

use App\Models\Diak;
use App\Models\Ertekeles;
use App\Models\Keses;
use App\Models\Szulo;
use App\Models\Tanar;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class Editcontroller extends Controller
{
    public function tantargyvalaszt()
    {
        $adatok = DB::table('tanars')->select(['tantargies.nev', 'tantargies.ID', 'tanars.azonosito'])
            ->join('tanoras', function ($join) {
                $join->on('tanars.azonosito', '=', 'tanoras.Tanar_azonosito');
            })
            ->join('tantargies', function ($join) {
                $join->on('tantargies.ID', '=', 'tanoras.Tantargy_ID');
            })
            ->join('diaks_tanoras', function ($join) {
                $join->on('tanoras.ID', '=', 'diaks_tanoras.Tanora_ID');
            })->where([
                ['tanoras.Tanar_Azonosito', '=', Auth::user()->azonosito]
            ])->groupBy('tantargies.ID', 'tantargies.nev', 'tanars.azonosito')->get();
        //dd($adatok);
        return View('tanar.ertekeles', ['status' => 1, 'adatok' => $adatok]);
    }

    public function diakvalaszt(Request $request)
    {

        $jegyek = DB::table('jegyeks')->select('jegy')->get();

        $adatok = DB::table('diaks')->select(['diaks.vnev', 'diaks.knev', 'diaks.azonosito', 'tantargies.nev', 'tantargies.ID', 'tanoras.Tanar_Azonosito'])
            ->join('diaks_tanoras', function ($join) {
                $join->on('diaks.azonosito', '=', 'diaks_tanoras.Diak_azonosito');
            })
            ->join('tanoras', function ($join) {
                $join->on('tanoras.ID', '=', 'diaks_tanoras.Tanora_ID');
            })
            ->join('tantargies', function ($join) {
                $join->on('tantargies.ID', '=', 'tanoras.Tantargy_ID');
            })->where([
                ['tanoras.Tanar_Azonosito', '=', Auth::user()->azonosito],
                ['tantargies.ID', '=', request('id')]
            ])->get();
        //dd($adatok);
        return View('tanar.ertekeles', ['status' => 2, 'adatok' => $adatok, 'jegyek' => $jegyek]);
    }

    public function tarolas(Request $request)
    {
        $e = new Ertekeles();
        $e->datum = now();
        $e->Tanar_Azonosito = Auth::user()->azonosito;
        $e->Diak_Azonosito = request('azonosito');
        $e->jegy = request('jegy');
        $e->Tantargy_ID = request('id');
        $e->save();
        return redirect('/ertekeles');
    }

    public function hianyzastarol(Request $request)
    {
        DB::table('keses')->select(['keses.igazolva', 'keses.ID'])
            ->where('ID', '=', request('id'))
            ->update(['igazolva' => 1]);

        DB::table('diaks')->select(['diaks.elerhetoIgazolasok', 'diaks.azonosito', 'keses.ID'])
            ->join('diaks_tanoras', function ($join) {
                $join->on('diaks_tanoras.Diak_azonosito', '=', 'diaks.azonosito');
            })
            ->join('keses', function ($join) {
                $join->on('diaks_tanoras.ID', '=', 'keses.Diak_tanora_ID');
            })
            ->where('keses.ID', '=', request('id'))
            ->update(['diaks.elerhetoIgazolasok' => DB::raw('elerhetoIgazolasok-1')]);

        return redirect('/hianyzas');
    }
}
