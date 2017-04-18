<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * 实例化的model对象
 */



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get('/',function(){
    return ['demo-name'=>'医院电子病历管理系统','version'=>'1.0'];
});

/**
 * 测试接口数据
 */
Route::any('/test',function(){
	return [
		[
			'name'=>'zhangsan',
			'sex' => 'male',
			'age' => 32,
			'address' => 'hfcjghfrdgfr',
			'message' => 'he is a good guy'
		],
		[
			'name'=>'lisi',
			'sex' => 'feale',
			'age' => 34,
			'address' => 'fjd efr klk as ihiod',
			'message' => 'she is a good girl'
		]
	];
});

/**
 * 用户登陆接口
 * 1.检查密码是否一致
 * 2.修改密码
 * 3.修改个人信息
 * 4.挂号信息,生成挂号码
 */
Route::group(['prefix'=>'user'],function(){
	Route::any('/checkpsw','UserController@checkpsw');
	Route::any('/changepsw','UserController@changepsw');
	Route::any('/changeinfo','UserController@changeinfo');
	Route::any('/makeregister','UserController@makeregister');
	Route::any('/checkRegID','UserController@checkRegID');

	Route::any('/getguahaoinfo','RegController@GetRegInfo');
});


/**
 * 医生表接口
 * 1.创建医生角色
 */
Route::group(['prefix'=>'doc'],function() {
	Route::any('/create','DoctorController@create');
	Route::any('/getDepartmentName','DoctorController@getDepartmentName');
	Route::any('/changepsw','DoctorController@docchangepsw');
	Route::any('/checkpsw','DoctorController@checkpsw');
	Route::any('/changeinfo','DoctorController@docchangeinfo');
	Route::any('/getUser','DoctorController@getUser');

	// 就诊 
	Route::any('/checkReg','RecordController@checkReg');
	Route::any('/setinitdata','RecordController@setInitData');
	Route::any('/writeRecord','RecordController@writeRecord');
	Route::any('/getTodayRecord','RecordController@getTodayRecord');

	// 医院基本信息
	Route::any('/getdocinfo','DoctorInfoController@getDocInfo');
	Route::any('/getonedocinfo','DoctorInfoController@getOneDocInfo');
	/*Route::any('/getUser','DoctorInfoController@getUser');
	Route::any('/getUser','DoctorInfoController@getUser');
	Route::any('/getUser','DoctorInfoController@getUser');*/
});

/**
 * 科室表接口
 * 1.创建科室
 */
Route::group(['prefix'=>'dep'],function() {
	Route::any('/create','DepartmentController@create');
});
