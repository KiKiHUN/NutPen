<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', function () {
    if (Auth::guard('szulo')->check()||Auth::guard('diak')->check()||Auth::guard('tanar')->check()||Auth::guard('admin')->check()) {
        return redirect('/Dashboard');
    }
    if ((Session::get('voltproba'))==true) {
        return view('login',['voltProba'=>true]);
    }else
    {
        return view('login',['voltProba'=>false]);
    }
})->name('login');

Route::post('/logincheck',[App\Http\Controllers\LoginController::class,'check']);



Route::group(['middleware' => 'auth:diak,szulo,tanar,admin'], function () {
    Route::get('/Dashboard',[App\Http\Controllers\ElvalasztoController::class,'Dash']);
    Route::get('/fiok',[App\Http\Controllers\ElvalasztoController::class,'fiok']);
    Route::get('/ertekeles',[App\Http\Controllers\ElvalasztoController::class,'ertekeles']);
    Route::get('/ora',[App\Http\Controllers\ElvalasztoController::class,'ora']);
    Route::get('/hianyzas',[App\Http\Controllers\ElvalasztoController::class,'hianyzas']);
    Route::post('/pwreset/save',[App\Http\Controllers\pwresetController::class,'check']);
    Route::get('/pwreset',[App\Http\Controllers\pwresetController::class,'resetpage']);
    Route::get('/logout',[App\Http\Controllers\LogoutController::class,'logout']);
});


Route::group(['middleware' => 'auth:tanar'], function () {
    Route::get('/ertekeles/tantargyvalaszt',[App\Http\Controllers\Editcontroller::class,'tantargyvalaszt']);
    Route::post('/ertekeles/diakvalaszt',[App\Http\Controllers\Editcontroller::class,'diakvalaszt']);
    Route::post('/ertekeles/tarolas',[App\Http\Controllers\Editcontroller::class,'tarolas']);
    Route::get('/hianyzas/tantargyvalaszt',[App\Http\Controllers\Editcontroller::class,'tantargyvalaszt']);
    Route::post('/hianyzas/diakvalaszt',[App\Http\Controllers\Editcontroller::class,'diakvalaszt']);
    Route::post('/hianyzas/tarolas',[App\Http\Controllers\Editcontroller::class,'tarolas']);
});

Route::group(['middleware' => 'auth:szulo'], function () {
    Route::post('/hianyzas/igazol',[App\Http\Controllers\Editcontroller::class,'igazolastarol']);
});


Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/targy',[App\Http\Controllers\ElvalasztoController::class,'targyListazas']);
    Route::get('/targy/uj',[App\Http\Controllers\ElvalasztoController::class,'targyHozzaad']);
    Route::post('/targy/ujtargy',[App\Http\Controllers\Editcontroller::class,'targyMentes']);

    Route::get('/kapcsolat/szulo',[App\Http\Controllers\ElvalasztoController::class,'diakSzuloListazas']);
    Route::get('/kapcsolat/szulo/uj',[App\Http\Controllers\ElvalasztoController::class,'diakSzuloHozzaad']);
    Route::post('/kapcsolat/szulo/ujkapcs',[App\Http\Controllers\Editcontroller::class,'diakSzuloMentes']);

    Route::get('/kapcsolat/ora',[App\Http\Controllers\ElvalasztoController::class,'diakOraListazas']);
    Route::get('/kapcsolat/ora/uj',[App\Http\Controllers\ElvalasztoController::class,'diakOraHozzaad']);
    Route::post('/kapcsolat/ora/ujkapcs',[App\Http\Controllers\Editcontroller::class,'diakOraMentes']);

    Route::get('/felhasznalok',[App\Http\Controllers\ElvalasztoController::class,'felhListazas']);
    Route::get('/felhasznalok/uj',[App\Http\Controllers\ElvalasztoController::class,'felhHozzaad']);
    Route::post('/felhasznalok/ujFelh',[App\Http\Controllers\Editcontroller::class,'felhMentes']);

    Route::get('/ora/uj',[App\Http\Controllers\ElvalasztoController::class,'oraFelvetel']);
    Route::post('/ora/ujOra',[App\Http\Controllers\Editcontroller::class,'oramentes']);
});
