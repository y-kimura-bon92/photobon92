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


// 画像投稿フォーム
Route::get('/form', 'UploadImageController@getForm')->name('getForm');
// 画像アップロード処理
Route::post('/upload', 'UploadImageController@postUpload')->name('postUpload');

// 画像一覧画面
Route::get('/list', 'ImageListController@getList')->name('getList');



// Admin
//==========================================================================
// 画像一覧画面
Route::get('/list_92', 'AdminController@getList_92')->name('getList_92');
// 画像アップデート
Route::post('/update_92', 'AdminController@postUpdate_92')->name('postUpdate_92');
// 画像編集画面
Route::get('/details_92/{id}', 'AdminController@getDetails_92')->name('getDetails_92');