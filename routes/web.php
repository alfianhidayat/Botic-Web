<?php

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $user = Auth::user();
    if ($user!=null){
        return redirect()->back();
    }else{
        return view('auth/login');
    }
});



Route::get('/home', 'MenuController@index');
Route::get('/help', 'MenuController@help');
Route::get('/list/{object}', 'MenuController@list');
Route::get('/list/{object}', 'MenuController@list');
Route::get('/superadmin', 'MenuController@superAdmin');
Route::get('/admin/insert', 'HomeController@insertAdmin');
Route::post('postAdmin', 'HomeController@storeAdmin');


Route::get('/admin', 'MenuController@admin');
Route::get('/user/insert', 'HomeController@insertUser');
Route::post('postUser', 'HomeController@storeUser');

Route::get('/booking', 'HomeController@booking');

Route::get('importExport', 'MenuController@importExport');
Route::get('downloadExcel/{type}', 'MenuController@downloadExcel');
Route::post('importExcel', 'MenuController@importExcel');

Route::post('showMenu/{id}/importExcel', 'HomeController@importExcel');

Auth::routes();


//MENU
Route::get('/menu', 'MenuController@index');
Route::post('/inputMenu', 'MenuController@store');
Route::get('/showMenu/{id}', 'MenuController@show');

//CATEGORY
Route::post('/inputCategory', 'CategoryController@store');
Route::get('/showMenu/data/{id}/{id_menu}/delete', 'HomeController@hapusKategori');

//HOTEL
Route::get('showMenu/data/{id}/{id_menu}', 'HomeController@show');

Route::get('showMenu/data/{id}/{id_menu}/insert', 'HomeController@insert');
Route::get('showMenu/{id_menu}/insert', 'HomeController@insertNo');

Route::get('showMenu/{id}/export', 'HomeController@export');
Route::post('showMenu/export', 'HomeController@export');

Route::get('showMenu/{id}/deleteAll', 'HomeController@deleteRecord');

Route::post('showMenu/{id_menu}/insert/post','HomeController@storeNo');
Route::post('showMenu/data/{id}/{id_menu}/insert/post','HomeController@store');
Route::post('showMenu/{id}/{id_menu}/insert-with-category/posted','HomeController@store');

Route::get('/showMenu/{id}/{id_category}/{id_menu}/view', 'HomeController@lihat');
Route::get('/showMenu/data/{id_category}/{id}/{id_menu}/view', 'HomeController@view');
Route::get('/showMenu/{id}/{id_menu}/view', 'HomeController@viewNo');

Route::get('/showMenu/{id}/{id_menu}/edit', 'HomeController@ubah');
Route::get('/showMenu/data/{id_category}/{id}/{id_menu}/edit', 'HomeController@edit');


Route::put('/showMenu/{id}/{id_menu}/update', 'HomeController@simpan');
Route::put('/showMenu/data/{id_category}/{id}/{id_menu}/update', 'HomeController@update');
Route::put('/showMenu/{id}/{id_menu}/update', 'HomeController@updateNo');

Route::delete('deleteAdmin', 'HomeController@deleteAdmin');
Route::delete('/showMenu/{id}/{id_menu}/delete', 'HomeController@hapus');
Route::delete('/showMenu/data/{id_category}/{id}/{id_menu}/delete', 'HomeController@destroy');
Route::delete('/showMenu/{id}/{id_category}/{id_menu}/delete', 'HomeController@destroys');

Route::post('upload/uploadFiles','HomeController@multipleUpload');

Route::get('deleteImage/{id_image}', 'HomeController@deleteImage');

Route::put('/showMenu/data/{id_category}/updateBooking', 'HomeController@updateBooking');

Route::get('maps', 'HomeController@maps');

Route::post('{id}/invoice', 'HomeController@invoice');

Route::get('editProfile', 'HomeController@editProfile');
Route::post('updateProfile', 'HomeController@updateProfile');
