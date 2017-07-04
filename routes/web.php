<?php

Route::get('/', function () {
    return view('auth/login');
});



Route::get('/home', 'MenuController@index');

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
Route::get('showMenu/{id}/insert-with-category', 'HomeController@insertWithCategory');

Route::get('showMenu/{id}/deleteAll', 'HomeController@deleteRecord');

Route::post('showMenu/data/{id}/{id_menu}/insert/post','HomeController@store');
Route::post('showMenu/{id}/{id_menu}/insert-with-category/posted','HomeController@store');

Route::get('/showMenu/{id}/{id_category}/{id_menu}/view', 'HomeController@lihat');
Route::get('/showMenu/data/{id_category}/{id}/{id_menu}/view', 'HomeController@view');


Route::get('/showMenu/{id}/{id_menu}/edit', 'HomeController@ubah');
Route::get('/showMenu/data/{id_category}/{id}/{id_menu}/edit', 'HomeController@edit');


Route::put('/showMenu/{id}/{id_menu}/update', 'HomeController@simpan');
Route::put('/showMenu/data/{id_category}/{id}/{id_menu}/update', 'HomeController@update');

Route::get('/showMenu/{id}/{id_menu}/delete', 'HomeController@hapus');
Route::get('/showMenu/data/{id_category}/{id}/{id_menu}/delete', 'HomeController@destroy');

Route::post('upload/uploadFiles','HomeController@multipleUpload');

Route::get('deleteImage/{id_image}', 'HomeController@deleteImage');