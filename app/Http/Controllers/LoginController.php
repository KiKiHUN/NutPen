<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{
    function check(Request $request)
    {
        $azonosito=$request->post('azonosito');
        $jelszo=$request->post('jelszo');
        //dd($azonosito);
        //dd($jelszo); //jok ezek
        $AzonositoValaszto = mb_substr($azonosito, 0, 1);
        $db=null;
        switch ($AzonositoValaszto) {
            case 'd':
                $db=DB::table('diaks')->select('azonosito','vnev','knev','jelszo');
                break;
            case 's':
                $db=DB::table('szulos')->select('azonosito','vnev','knev','jelszo');
                break;
            case 't':
                $db=DB::table('tanars')->select('azonosito','vnev','knev','jelszo');
                break;

            default:
                $db=null;
                break;
        }
        if ($db===null) {
            return view('login',['voltProba'=>true]);
        }
        if($db->where('azonosito' ,'=', $azonosito)->exists())
        {
            $nev=$db->select('vnev')." ".$db->select('knev');
        }else
        {
            return view('login',['voltProba'=>true]);
        };

        //return view('flights.show',['flight'=>$flight]);
    }
}
