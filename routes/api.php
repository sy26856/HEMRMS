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
 * 用户登陆接口
 */
Route::any('/user/login','Auth\LoginController@index');

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