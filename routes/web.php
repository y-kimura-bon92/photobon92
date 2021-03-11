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



/*====================================================================
* ユーザーノーマルページ
====================================================================*/ 
// 画像一覧画面
Route::get('/list', 'ImageListController@getList')->name('getList');



/*====================================================================
* ユーザーシークレットページ
====================================================================*/ 
// 画像一覧画面
Route::get('/se/list', 'SeUploadImageController@SeGetList')->name('SeGetList');



/*====================================================================
* 管理者ノーマルページ
====================================================================*/ 
// 画像投稿フォーム
Route::get('/form_92', 'AdminController@getForm_92')->name('getForm_92');
// 画像アップロード処理
Route::post('/upload_92', 'AdminController@postUpload_92')->name('postUpload_92');
// 画像一覧画面
Route::get('/list_92', 'AdminController@getList_92')->name('getList_92');
// 画像アップデート
Route::post('/update_92', 'AdminController@postUpdate_92')->name('postUpdate_92');
// 画像編集画面
Route::get('/details_92/{id}', 'AdminController@getDetails_92')->name('getDetails_92');
// 画像削除
Route::post('/delete_92/{id}', 'AdminController@postDelete_92')->name('postDelete_92');



/*====================================================================
* 管理者シークレットページ
====================================================================*/ 
// 画像編集画面
Route::get('/se/details_92/{id}', 'SeAdminController@SeGetDetails_92')->name('SeGetDetails');
// 画像投稿フォーム
Route::get('/se/form_92', 'SeAdminController@SeGetForm_92')->name('SeGetForm_92');
// 画像アップロード処理
Route::post('/se/upload_92', 'SeAdminController@SePostUpload_92')->name('SePostUpload_92');
// 画像一覧画面（管理者）
Route::get('/se/list_92', 'SeAdminController@SeGetList_92')->name('SeGetList_92');
// 画像アップデート
Route::post('/se/update_92', 'SeAdminController@SePostUpdate_92')->name('SePostUpdate_92');

// 画像削除
Route::post('/se/delete_92/{id}', 'SeAdminController@SePostDelete_92')->name('SePostDelete_92');




