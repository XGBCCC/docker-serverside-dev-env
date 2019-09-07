<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    if (Auth::check()) {
        return redirect('/notifications');
    }
    else {
        return redirect('/login');
    }
});

Auth::routes(); // Laravel handles login

Route::middleware(['auth'])->group(function() {
    Route::get('/{any}', function() {
        return view('app');
    });
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
