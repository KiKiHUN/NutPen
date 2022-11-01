<?php

use Illuminate\Http\Request;
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
Route::get('/login', function (Request $request) {
    if ((Session::get('voltproba'))==true) {
        return view('login',['voltProba'=>true]);
    }else
    {
        return view('login',['voltProba'=>false]);
    }
});

Route::post('/logincheck',[App\Http\Controllers\LoginController::class,'check']);
