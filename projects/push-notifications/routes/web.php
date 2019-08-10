<?php

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

Auth::routes();

Route::get('/', function () {
    if (Auth::check()){
        return redirect('/notifications');
    } else {
        return redirect('/login');
    }
});

//Route::middleware(['auth'])->group(function(){
//    Route::get('notifications',function(){
//        return view('notifications',[
//            'activePage' => 2
//        ]);
//    });
//});
