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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/my_home','mysController@index');

//登录
Route::get('/login','LoginController@index');
Route::post('/goLogin','LoginController@login');

//注册
Route::get('/register','LoginController@registerShow');
Route::post('/goRegister','LoginController@toRegister');

//改密码
Route::any('/editPsw','LoginController@editPswShow');
Route::get('/getInfo','LoginController@getInfo');
Route::post('/goEditPsw','LoginController@EditPsw');

Route::get('/dele','LoginController@goDel');