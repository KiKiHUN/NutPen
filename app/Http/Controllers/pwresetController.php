<?php

namespace App\Http\Controllers;

use App\Models\Diak;
use App\Models\Szulo;
use App\Models\Tanar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pwresetController extends Controller
{
    function resetpage()
    {

        return view('reset',['azonosito'=>Auth::user()->azonosito]);
    }

    function check(Request $request)
    {
        $azonosito=Auth::user()->azonosito;
        $jelszo=$request->post('jelszo1');
        //dd($azonosito);
        //dd($jelszo); //jok ezek
        $AzonositoValaszto = mb_substr($azonosito, 0, 1);
        switch ($AzonositoValaszto) {
            case 'd':
                $user= Diak::findOrFail($azonosito);

                if ($user)
                {
                    $user->jelszo =hasheles( $jelszo);
                    try {
                        $user->save();
                    } catch (\Exception $e) {
                        echo(" <script>alert('Sikertelen módosítás'); </script>");
                        return redirect('/pwreset');
                    }
                    Auth::guard('diak')->login($user);
                    echo(" <script>alert('Sikeres módosítás'); </script>");
                    return redirect('/Dashboard');
                }else {
                    echo(" <script>alert('Sikertelen módosítás'); </script>");
                    return redirect('/pwreset');
                }
                break;
            case 's':
                $user= Szulo::findOrFail($azonosito);

                if ($user)
                {
                    $user->jelszo = hasheles( $jelszo);
                    try {
                        $user->save();
                    } catch (\Exception $e) {
                        echo(" <script>alert('Sikertelen módosítás'); </script>");
                        sleep(2);
                        return redirect('/pwreset');
                    }
                    Auth::guard('szulo')->login($user);
                    echo(" <script>alert('Sikeres módosítás'); </script>");
                    sleep(2);
                    return redirect('/Dashboard');
                }else {
                    echo(" <script>alert('Sikertelen módosítás'); </script>");
                    sleep(2);
                    return redirect('/pwreset');
                }
                break;
            case 't':
                $user= Tanar::findOrFail($azonosito);

                if ($user)
                {
                    $user->jelszo = hasheles( $jelszo);
                    try {
                        $user->save();
                    } catch (\Exception $e) {
                        echo(" <script>alert('Sikertelen módosítás'); </script>");
                        sleep(2);
                        return redirect('/pwreset');
                    }
                    Auth::guard('tanar')->login($user);
                    echo(" <script>alert('Sikeres módosítás'); </script>");
                    sleep(2);
                    return redirect('/Dashboard');
                }else {
                    echo(" <script>alert('Sikertelen módosítás'); </script>");
                    sleep(2);
                    return redirect('/pwreset');
                }
                break;
            default:
            echo(" <script>alert('Sikertelen módosítás'); </script>");
            sleep(2);
            return redirect('/pwreset');
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
