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

Route::group(['prefix'=>'user'],function(){
    Route::any('inforead',"HomeController@inforead");
    Route::any('infoedit','HomeController@infoedit');
    Route::any('/changepsw','HomeController@changepsw');
    Route::any('/registes','HomeController@registes');
    Route::any('/guahaoinfo','HomeController@guahaoinfo');

    Route::any('/project','HomeController@project');
    Route::any('/inproject','HomeController@inproject');

    Route::any('/inhos','HomeController@inhos');
    Route::any('/outhos','HomeController@outhos');
    Route::any('/passRecord','HomeController@passRecord');
});

Route::group(['prefix'=>'doc'],function(){
    Route::any('/login','DoctorController@login');
    Route::any('/index','DoctorController@index');
    Route::any('/index/info11','DoctorController@index');
    Route::any('/logout','DoctorController@logout');
    Route::any('/inforead','DoctorController@inforead');
    Route::any('/changepsw','DoctorController@changepsw');
    Route::any('/infoedit','DoctorController@infoedit');
    Route::any('/passrecord','DoctorController@passRecord');
    Route::any('/writerecord','DoctorController@writeRecord');
    Route::any('/todayrecord','DoctorController@todayRecord');
    Route::any('/checkPro','DoctorController@checkPro');

    // 医院基本信息
    Route::any('/docinfo','DoctorInfoController@docinfo');
    Route::any('/depinfo','DoctorInfoController@depinfo');
    Route::any('/bedinfo','DoctorInfoController@bedinfo');
    Route::any('/proinfo','DoctorInfoController@proinfo');

    // 住院出院
    Route::any('/inhos','HosInfoController@inhos');
    Route::any('/outhos','HosInfoController@outhos');
});
