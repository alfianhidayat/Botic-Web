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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::resource('user', 'ApiUserController');
Route::resource('tourism', 'ApiTourismController');
Route::resource('shopping', 'ApiShoppingController');
Route::resource('hotel', 'ApiHotelController');
Route::resource('culinary', 'ApiCulinaryController');
Route::resource('transportation', 'ApiTransportationController');
Route::resource('praying', 'ApiTempatIbadahController');
Route::resource('publicService', 'ApiPublicServiceController');
Route::resource('finance', 'ApiFinanceController');
Route::resource('health', 'ApiHealthController');
Route::resource('leisure', 'ApiLeisureController');
Route::resource('booking', 'ApiBookingController');
Route::resource('review', 'ApiReviewController');
Route::resource('checkin', 'ApiCheckInController');
Route::get('listasset', 'ApiBookingController@getListAsset');
Route::get('listidentity', 'ApiBookingController@getListIdentity');
Route::post('login', 'ApiUserController@login');
Route::get('picture/{id}', 'ApiPictureController@show');
