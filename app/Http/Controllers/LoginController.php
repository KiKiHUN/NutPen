<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Diak;
use App\Models\Szulo;
use App\Models\Tanar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    function check(Request $request)
    {
        $azonosito=$request->post('azonosito');
        $jelszo=$request->post('jelszo');
        //dd($azonosito);
        //dd($jelszo); //jok ezek
        $AzonositoValaszto = mb_substr($azonosito, 0, 1);
        switch ($AzonositoValaszto) {
            case 'd':
                $user = Diak::where([
                    'azonosito' => $azonosito,
                    'jelszo' => hasheles($jelszo)
                ])->first();
                if ($user)
                {
                    Auth::guard('diak')->login($user);
                    return redirect('/Dashboard');
                }else {
                    return redirect('/login')->with('voltproba', true);
                }
                break;
            case 's':
                $user = Szulo::where([
                    'azonosito' => $azonosito,
                    'jelszo' => hasheles($jelszo)
                ])->first();

                if ($user)
                {
                    Auth::guard('szulo')->login($user);
                    return redirect('/Dashboard');
                }else {
                    return redirect('/login')->with('voltproba', true);
                }
                break;
            case 't':
                $user = Tanar::where([
                    'azonosito' => $azonosito,
                    'jelszo' => hasheles($jelszo)
                ])->first();

                if ($user)
                {
                    Auth::guard('tanar')->login($user);
                    return redirect('/Dashboard');
                }else {
                    return redirect('/login')->with('voltproba', true);
                }
                break;
                case 'a':
                    $user = Admin::where([
                        'azonosito' => $azonosito,
                        'jelszo' => hasheles($jelszo)
                    ])->first();

                    if ($user)
                    {
                        Auth::guard('admin')->login($user);
                        return redirect('/Dashboard');
                    }else {
                        return redirect('/login')->with('voltproba', true);
                    }
                    break;
            default:
                return redirect('/login')->with('voltproba', true);
                break;
        }




        //return view('flights.show',['flight'=>$flight]);
    }

}
    function hasheles($be)
    {

        $prefix = '$2y$';
        $cost = '10';
        $salt = '$thisisahardcodedsalt$';
        $blowfishPrefix = $prefix.$cost.$salt;
        $password = $be;
        $hash = crypt($password, $blowfishPrefix);
       return  $hash;
    }
