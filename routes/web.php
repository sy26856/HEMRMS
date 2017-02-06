<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/doclogin',function() {
    return view('auth.doclogin');
});

Route::group(['prefix'=>'doc'],function(){
    Route::any('/login','DoctorController@login');
    Route::any('/index','DoctorController@index');
    Route::any('/logout','DoctorController@logout');
});

Route::group(['prefix'=>'user'],function(){
    Route::any('inforead',"HomeController@inforead");
    Route::any('infoedit','HomeController@infoedit');
    Route::any('/changepsw','HomeController@changepsw');
    Route::any('/registes','HomeController@registes');
});
