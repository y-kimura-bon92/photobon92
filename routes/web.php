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

// TOPページ
Route::get('/', 'HomeController@showHome')->name('home');


// 画像入力画面
Route::get('photo-form', 'UploadImageController@getForm')->name('getForm');
// 画像入力確認画面
Route::post('photo-upload', 'UploadImageController@postUpload')->name('postUpload');



// 画像一覧画面
Route::get('/list', 'ImageListController@getList')->name('getList');
