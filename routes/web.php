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

//INDEX
Route::get('/home', 'MenuController@index');

//HELP
Route::get('/help', 'MenuController@help');

//DAFTAR MENU DAN KATEGORI
Route::get('/list/{object}', 'MenuController@list');

//USER
Route::get('editProfile', 'HomeController@editProfile');
Route::post('updateProfile', 'HomeController@updateProfile');

//SUPER ADMIN
Route::get('/superadmin', 'MenuController@superAdmin');
Route::get('/admin/insert', 'HomeController@insertAdmin');
Route::post('postAdmin', 'HomeController@storeAdmin');

//ADMIN
Route::get('/admin', 'MenuController@admin');
Route::get('/user/insert', 'HomeController@insertUser');
Route::post('postUser', 'HomeController@storeUser');

//BOOKING
Route::get('/booking', 'HomeController@booking');

//IMPORT EXPORT
Route::get('importExport', 'MenuController@importExport');
Route::get('downloadExcel/{type}', 'MenuController@downloadExcel');
Route::post('importExcel', 'MenuController@importExcel');
Route::post('showMenu/{id}/importExcel', 'HomeController@importExcel');
Route::get('showMenu/{id}/export', 'HomeController@export');
Route::post('showMenu/export', 'HomeController@export');

Auth::routes();


//MENU
Route::get('/menu', 'MenuController@index');
Route::post('/inputMenu', 'MenuController@store');
Route::get('/showMenu/{id}', 'MenuController@show');

//CATEGORY
Route::post('/inputCategory', 'CategoryController@store');
Route::get('/showMenu/data/{id}/{id_menu}/delete', 'HomeController@hapusKategori');

//READ
Route::get('showMenu/data/{id}/{id_menu}', 'HomeController@show');

//INSERT
Route::get('showMenu/data/{id}/{id_menu}/insert', 'HomeController@insert');
Route::get('showMenu/{id_menu}/insert', 'HomeController@insertNo');

//DELETE ALL RECORD
Route::get('showMenu/{id}/deleteAll', 'HomeController@deleteRecord');

//CREATE
Route::post('showMenu/{id_menu}/insert/post','HomeController@storeNo');
Route::post('showMenu/data/{id}/{id_menu}/insert/post','HomeController@store');
Route::post('showMenu/{id}/{id_menu}/insert-with-category/posted','HomeController@store');

//VIEW (READ)
Route::get('/showMenu/{id}/{id_category}/{id_menu}/view', 'HomeController@lihat');
Route::get('/showMenu/data/{id_category}/{id}/{id_menu}/view', 'HomeController@view');
Route::get('/showMenu/{id}/{id_menu}/view', 'HomeController@viewNo');

//EDIT
Route::get('/showMenu/{id}/{id_menu}/edit', 'HomeController@ubah');
Route::get('/showMenu/data/{id_category}/{id}/{id_menu}/edit', 'HomeController@edit');

//UPDATE
Route::put('/showMenu/{id}/{id_menu}/update', 'HomeController@simpan');
Route::put('/showMenu/data/{id_category}/{id}/{id_menu}/update', 'HomeController@update');
Route::put('/showMenu/{id}/{id_menu}/update', 'HomeController@updateNo');


//DELETE
Route::delete('deleteAdmin', 'HomeController@deleteAdmin');
Route::delete('/showMenu/{id}/{id_menu}/delete', 'HomeController@hapus');
Route::delete('/showMenu/data/{id_category}/{id}/{id_menu}/delete', 'HomeController@destroy');
Route::delete('/showMenu/{id}/{id_category}/{id_menu}/delete', 'HomeController@destroys');

//UPLOAD IMAGE
Route::post('upload/uploadFiles','HomeController@multipleUpload');

//DELETE IMAGE
Route::get('deleteImage/{id_image}', 'HomeController@deleteImage');

//BOOKING
Route::put('/showMenu/data/{id_category}/updateBooking', 'HomeController@updateBooking');
Route::post('{id}/invoice', 'HomeController@invoice');