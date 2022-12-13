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
    if (Auth::guard('szulo')->check()||Auth::guard('diak')->check()||Auth::guard('tanar')->check()) {
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



Route::group(['middleware' => 'auth:diak,szulo,tanar'], function () {
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
});

Route::group(['middleware' => 'auth:szulo'], function () {
    Route::post('/hianyzas/igazol',[App\Http\Controllers\Editcontroller::class,'hianyzastarol']);
});


