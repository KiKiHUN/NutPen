<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Diak;
use App\Models\Szulo;
use App\Models\Tanar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ElvalasztoController extends Controller
{

//////////////    Mindneki    //////////////
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
            case 'a':
                $user = Admin::where(['azonosito' => Auth::user()->azonosito])->first();
                return View('admin.admin_dashboard',['user'=>$user]);
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
            case 'a':
                $user=DB::table('admins')->join('felh_tipuses', function ($join) {
                    $join->on('admins.felh_tipus_ID', '=', 'felh_tipuses.ID')->where('admins.azonosito', '=', Auth::user()->azonosito);
                })->first();
                return View('info',['user'=>$user]);
                break;
        }
   }
////////////////////////////////////////////



//////////////  Diák Tanár Admin   //////////////
   public function ora()
   {
        $azonositoValaszto = mb_substr(Auth::user()->azonosito, 0, 1);

        switch ($azonositoValaszto) {
            case 'd':
                $orarend=DB::table('tantargies')->join('tanoras', function ($join) {
                    $join->on('tanoras.Tantargy_ID', '=', 'tantargies.ID');
                })
                ->join('diaks_tanoras', function ($join) {
                    $join->on('diaks_tanoras.Tanora_ID', '=', 'tanoras.ID');
                })->where('diaks_tanoras.Diak_azonosito','=',Auth::user()->azonosito)
                ->get();

                return View('diak.ora',['orarend'=>$orarend]);
                break;

            case 't':
                $targyak=DB::table('tantargies')->join('tanoras', function ($join) {
                    $join->on('tanoras.Tantargy_ID', '=', 'tantargies.ID');
                })
                ->join('tanars', function ($join) {
                    $join->on('tanars.azonosito', '=', 'tanoras.Tanar_azonosito');
                })->where('tanoras.Tanar_azonosito','=',Auth::user()->azonosito)
                ->get();
                return View('tanar.ora',['targyak'=>$targyak]);
                break;
            case 'a':
                $targyak=DB::table('tantargies')->select(['tanoras.ID','tanars.vnev','tanars.knev','tantargies.nev','tanars.azonosito','tanoras.kezdet','tanoras.veg'])
                ->join('tanoras', function ($join) {
                    $join->on('tanoras.Tantargy_ID', '=', 'tantargies.ID');
                })
                ->join('tanars', function ($join) {
                    $join->on('tanars.azonosito', '=', 'tanoras.Tanar_azonosito');
                })
                ->orderBy("tanoras.kezdet", 'DESC')
                ->get();
                return View('admin.ora',['status'=>0,'targyak'=>$targyak]);

        }
   }
/////////////////////////////////////////////////


//////////////  Diák szülő Tanár  //////////////
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

   public function hianyzas()
   {
    $azonositoValaszto = mb_substr(Auth::user()->azonosito, 0, 1);

    switch ($azonositoValaszto) {
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
////////////////////////////////////////////////


//////////////    Admin   //////////////
   public function felhListazas()
   {
        $diakok=DB::table('diaks')->select(['diaks.vnev','diaks.knev','diaks.azonosito','felh_tipuses.Tipus'])
        ->join('felh_tipuses', function ($join) {
            $join->on('felh_tipuses.ID', '=', 'diaks.felh_tipus_ID');
        })->get();
        $tanarok=DB::table('tanars')->select(['tanars.vnev','tanars.knev','tanars.azonosito','felh_tipuses.Tipus'])
        ->join('felh_tipuses', function ($join) {
            $join->on('felh_tipuses.ID', '=', 'tanars.felh_tipus_ID');
        })->get();
        $szulok=DB::table('szulos')->select(['szulos.vnev','szulos.knev','szulos.azonosito','felh_tipuses.Tipus'])
        ->join('felh_tipuses', function ($join) {
            $join->on('felh_tipuses.ID', '=', 'szulos.felh_tipus_ID');
        })->get();
        $result = $diakok->merge($tanarok)->merge($szulok);
        return View('admin.Felh',['status'=>0,'felhasznalok'=>$result]);
   }

   public function felhHozzaad()
   {
    $felhTipus=DB::table('felh_tipuses')->select(['felh_tipuses.Tipus','felh_tipuses.ID'])->get();
    return View('admin.Felh',['status'=>1,'felhTipus'=>$felhTipus]);
   }

   public function oraFelvetel()
   {
       $tanarok = DB::table('tanars')->select(['tanars.vnev', 'tanars.knev', 'tanars.azonosito'])->get();
       $tantargyak = DB::table('tantargies')->select(['tantargies.nev', 'tantargies.ID'])->get();
       return View('admin.ora', ['status' => 1, 'tanarok' => $tanarok,'tantargyak'=>$tantargyak]);
   }

   public function diakSzuloListazas()
   {
    $kapcsolatok=DB::table('diaks_szulos')->select(['diaks.vnev  as diak_vnev','diaks.knev as diak_knev','diaks.azonosito as diak_azon','szulos.vnev as szulo_vnev','szulos.knev as szulo_knev','szulos.azonosito as szulo_azon'])
    ->join('diaks', function ($join) {
        $join->on('diaks_szulos.diak_azonosito', '=', 'diaks.azonosito');
    })
    ->join('szulos', function ($join) {
        $join->on('diaks_szulos.szulo_azonosito', '=', 'szulos.azonosito');
    })
    ->get();
    return View('admin.diakSzuloKapcsolat',['status'=>0,'kapcsolatok'=>$kapcsolatok]);
   }

   public function diakSzuloHozzaad()
   {
    $diakok=DB::table('diaks')->select(['diaks.vnev','diaks.knev','diaks.azonosito','felh_tipuses.Tipus'])
    ->join('felh_tipuses', function ($join) {
        $join->on('felh_tipuses.ID', '=', 'diaks.felh_tipus_ID');
    })->get();
    $szulok=DB::table('szulos')->select(['szulos.vnev','szulos.knev','szulos.azonosito','felh_tipuses.Tipus'])
    ->join('felh_tipuses', function ($join) {
        $join->on('felh_tipuses.ID', '=', 'szulos.felh_tipus_ID');
    })->get();
    return View('admin.diakSzuloKapcsolat',['status'=>1,'diakok'=>$diakok,'szulok'=>$szulok]);
   }

   public function diakOraListazas()
   {
    $kapcsolatok=DB::table('diaks_tanoras')->select(['diaks.vnev  as diak_vnev','diaks.knev as diak_knev','diaks.azonosito as diak_azon','tantargies.nev','tanoras.kezdet','tanoras.veg','tanars.azonosito as tanar_azon','tanars.vnev as tanar_vnev','tanars.knev as tanar_knev'])
    ->join('diaks', function ($join) {
        $join->on('diaks_tanoras.diak_azonosito', '=', 'diaks.azonosito');
    })
    ->join('tanoras', function ($join) {
        $join->on('diaks_tanoras.tanora_ID', '=', 'tanoras.ID');
    })
    ->join('tantargies', function ($join) {
        $join->on('tanoras.tantargy_ID', '=', 'tantargies.ID');
    })
    ->join('tanars', function ($join) {
        $join->on('tanoras.tanar_azonosito', '=', 'tanars.azonosito');
    })
    ->get();
    return View('admin.diakOraKapcsolat',['status'=>0,'kapcsolatok'=>$kapcsolatok]);
   }

   public function diakOraHozzaad()
   {
    $diakok=DB::table('diaks')->select(['diaks.vnev','diaks.knev','diaks.azonosito'])->get();

    $tanorak=DB::table('tanoras')->select(['tanoras.id','tantargies.nev','tanoras.kezdet','tanoras.veg',"tanars.vnev","tanars.knev","tanars.azonosito"])
    ->join('tantargies', function ($join) {
        $join->on('tanoras.tantargy_ID', '=', 'tantargies.ID');
    })
    ->join('tanars', function ($join) {
        $join->on('tanoras.tanar_azonosito', '=', 'tanars.azonosito');
    })->get();
    return View('admin.diakOraKapcsolat',['status'=>1,'diakok'=>$diakok,'tanorak'=>$tanorak]);
   }
////////////////////////////////////////
}
