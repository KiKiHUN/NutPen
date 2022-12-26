<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Diak;
use App\Models\Ertekeles;
use App\Models\Keses;
use App\Models\Szulo;
use App\Models\Tanar;
use App\Models\Tanora;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\general;
use Faker\Factory as Faker;

class Editcontroller extends Controller
{
    public function tantargyvalaszt(Request $request)
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
        if ($request->path() == "ertekeles/tantargyvalaszt") {
            return View('tanar.ertekeles', ['status' => 1, 'adatok' => $adatok]);
        } elseif ($request->path() == "hianyzas/tantargyvalaszt") {
            return View('tanar.hianyzas', ['status' => 1, 'adatok' => $adatok]);
        }
    }

    public function diakvalaszt(Request $request)
    {
        //dd($adatok);
        if ($request->path() == "ertekeles/diakvalaszt") {
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
            $jegyek = DB::table('jegyeks')->select('jegy')->get();
            return View('tanar.ertekeles', ['status' => 2, 'adatok' => $adatok, 'jegyek' => $jegyek]);
        } elseif ($request->path() == "hianyzas/diakvalaszt") {
            $adatok = DB::table('diaks')->select(['diaks.vnev', 'diaks.knev', 'diaks.azonosito', 'tantargies.nev', 'tantargies.ID', 'diaks_tanoras.ID as tanoraid', 'tanoras.Tanar_Azonosito', 'tanoras.kezdet', 'tanoras.veg'])
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
            return View('tanar.hianyzas', ['status' => 2, 'adatok' => $adatok]);
        }
    }

    public function tarolas(Request $request)
    {
        if ($request->path() == "ertekeles/tarolas") {
            $e = new Ertekeles();
            $e->datum = now();
            $e->Tanar_Azonosito = Auth::user()->azonosito;
            $e->Diak_Azonosito = request('azonosito');
            $e->jegy = request('jegy');
            $e->Tantargy_ID = request('id');
            $e->save();
            return redirect('/ertekeles');
        } elseif ($request->path() == "hianyzas/tarolas") {
            error_log($request->adatok);
            $kilista = json_decode($request->input('adatok'), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                error_log("hiba: " . json_last_error_msg());
            } else {
                try {
                    foreach ($kilista as $item) {

                        $k = new Keses();
                        $k->Diak_tanora_ID = $item['diakTanoraID'];
                        $k->Kesett_perc = $item['kesettperc'];
                        $k->Datum = now();
                        $k->igazolva = 0;
                        $k->save();
                    }
                    return response()->json("akurvaeletmukodik", 200);
                } catch (\Throwable $th) {
                    return response()->json("hatbazdmegvalamirossz", 400);
                }
            }
        }
    }

    public function igazolastarol()
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


    public function oramentes(Request $request)
    {
        try {
            $t = new Tanora();
            $t->Tantargy_ID = $request->tantargyak;
            $t->kezdet = $request->kezdet;
            $t->veg = $request->veg;
            $t->Tanar_azonosito = $request->tanarok;
            $t->save();
            return redirect('/ora');
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'Sikertelen mentés');
        }
    }


    public function felhMentes(Request $request)
    {
        $f = null;
        $good = false;
        $azon = "";
        $faker = Faker::create();
        switch ($request->tipus) {
            case "1":
                $f = new Diak();
                $i = 0;
                while (!$good) {
                    $azon = $faker->bothify('d#?#?#');
                    $user = Diak::where([
                        'azonosito' => $azon
                    ])->first();

                    if (!$user) {
                        $good = true;
                    }
                    if ($i >= 5000) {
                        break;
                    }
                    $i += 1;
                }
                break;
            case "2":
                $f = new Tanar();
                $i = 0;
                while (!$good) {
                    $azon =$faker->bothify('t#?#?#');
                    $user = Tanar::where([
                        'azonosito' => $azon
                    ])->first();

                    if (!$user) {
                        $good = true;
                    }
                    if ($i >= 5000) {
                        break;
                    }
                    $i += 1;
                }
                break;
            case "3":
                $f = new Szulo();
                $i = 0;
                while (!$good) {
                    $azon = $faker->bothify('s#?#?#');
                    $user = Szulo::where([
                        'azonosito' => $azon
                    ])->first();

                    if (!$user) {
                        $good = true;
                    }
                    if ($i >= 5000) {
                        break;
                    }
                    $i += 1;
                }
                break;
            case "4":
                $f = new Admin();
                $i = 0;
                while (!$good) {
                    $azon = $faker->bothify('a#?#?#');
                    $user = Admin::where([
                        'azonosito' => $azon
                    ])->first();

                    if (!$user) {
                        $good = true;
                    }
                    if ($i >= 5000) {
                        break;
                    }
                    $i += 1;
                }
                break;
        }
        if ($good) {
            $prefix = '$2y$';
            $cost = '10';
            $salt = '$thisisahardcodedsalt$';
            $blowfishPrefix = $prefix.$cost.$salt;
            $password = $request->pw;
            $hash = crypt($password, $blowfishPrefix);
            try {
                $f->vnev = $request->vnev;
                $f->knev = $request->knev;
                $f->felh_tipus_ID = $request->tipus;
                $f->azonosito= $azon;
                $f->jelszo= $hash;
                $f->save();
                return redirect('/felhasznalok');
            } catch (\Throwable $th) {
                return redirect()->back()->with('alert', 'Sikertelen mentés');
            }
        }
        else {
            return redirect()->back()->with('alert', 'Sikertelen mentés');
        }
    }
}
