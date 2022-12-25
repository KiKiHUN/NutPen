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



                $user=DB::table('diaks')->join('felh_tipuses', function ($join) {
                    $join->on('diaks.felh_tipus_ID', '=', 'felh_tipuses.ID')->where('diaks.azonosito', '=', Auth::user()->azonosito);
            })->first();


                return View('info',['user'=>$user]);
                break;
            case 's':
                $user=DB::table('szulos')->join('felh_tipuses', function ($join) {
                    $join->on('szulos.felh_tipus_ID', '=', 'felh_tipuses.ID')->where('szulos.azonosito', '=', Auth::user()->azonosito);
                })->first();

                return View('info',['user'=>$user]);
                break;
            case 't':
                $user=DB::table('tanars')->join('felh_tipuses', function ($join) {
                    $join->on('tanars.felh_tipus_ID', '=', 'felh_tipuses.ID')->where('tanars.azonosito', '=', Auth::user()->azonosito);
                })->first();
                return View('info',['user'=>$user]);
                break;
        }
   }
   public function hianyzas()
   {
    $azonositoValaszto = mb_substr(Auth::user()->azonosito, 0, 1);

    switch ($azonositoValaszto) {////////////////////////////nincs kész
        case 'd':
            $adat = DB::table('keses')->selectRaw("diaks_tanoras.Diak_azonosito,Kesett_perc,tanars.vnev,tanars.knev,tantargies.nev,tantargies.leiras,keses.Datum,keses.igazolva")
            ->join('diaks_tanoras', function ($join) {
                $join->on('diaks_tanoras.ID', '=', 'keses.Diak_tanora_ID');
            })
            ->join('tanoras', function ($join) {
                $join->on('tanoras.ID', '=', 'diaks_tanoras.Tanora_ID');
            })->join('tantargies', function ($join) {
                $join->on('tantargies.ID', '=', 'tanoras.Tantargy_ID');
            })->join('tanars', function ($join) {
                $join->on('tanars.azonosito', '=', 'tanoras.Tanar_azonosito');
            })->where('diaks_tanoras.Diak_azonosito','=',Auth::user()->azonosito)
            ->get();
            return View('diak.hianyzas',['adat'=>$adat]);
            break;

        case 's':
            $gyerekek=DB::table('diaks_szulos')->where('Szulo_azonosito', '=', Auth::user()->azonosito)->get();
            return View('szulo.hianyzas',['gyerekek'=>$gyerekek]);
            break;
        case 't':
            $adatok=DB::table('keses')->select(['diaks.vnev','diaks.knev','diaks_tanoras.ID','diaks.azonosito','tantargies.nev','Kesett_perc','Datum','igazolva'])
                        ->join('diaks_tanoras', function ($join) {
                            $join->on('keses.Diak_Tanora_ID', '=', 'diaks_tanoras.ID');
                        })
                        ->join('tanoras', function ($join) {
                            $join->on('diaks_tanoras.Tanora_ID', '=', 'tanoras.ID');
                        })
                        ->join('diaks', function ($join) {
                            $join->on('diaks_tanoras.Diak_azonosito', '=', 'diaks.azonosito');
                        })
                        ->join('tantargies', function ($join) {
                            $join->on('tanoras.Tantargy_ID', '=', 'tantargies.ID');
                        })
                        ->where([
                            ['tanoras.Tanar_Azonosito', '=', Auth::user()->azonosito ]
                        ])->get();
                        return View('tanar.hianyzas',['status'=>0,'adatok'=>$adatok]);
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
                    $adatok=DB::table('diaks')->select(['diaks.vnev','diaks.knev','diaks.azonosito','tantargies.nev','ertekeles.Tanar_Azonosito','ertekeles.jegy','ertekeles.datum'])
                        ->join('ertekeles', function ($join) {
                        $join->on('diaks.azonosito', '=', 'ertekeles.Diak_azonosito');
                        })
                        ->join('tanars', function ($join) {
                            $join->on('tanars.azonosito', '=', 'ertekeles.Tanar_Azonosito');
                        })
                        ->join('tantargies', function ($join) {
                            $join->on('tantargies.ID', '=', 'ertekeles.Tantargy_ID');
                        })->where([
                            ['ertekeles.Tanar_Azonosito', '=', Auth::user()->azonosito ]
                        ])->get();
                        return View('tanar.ertekeles',['status'=>0,'adatok'=>$adatok]);
                break;
        }
   }
}
