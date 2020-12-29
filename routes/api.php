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

Route::post('register',"Auth\Api\APIRegisterController@register");
Route::post('login',"Auth\Api\APILoginController@login");
Route::post('updateToken',"Auth\Api\APILoginController@updateToken");
Route::post('forgetpassword', 'Auth\Api\PasswordResetRequestController@sendPasswordResetEmail');
Route::post('forgetchangepassword', 'Auth\Api\PasswordResetRequestController@changepassword');
Route::post('verifycode', 'Auth\Api\PasswordResetRequestController@verifycode');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'jwt.auth'], function () {
Route::post('changepassword', 'Auth\Api\PasswordResetRequestController@change_password');
Route::post('editprofile', 'Auth\Api\PasswordResetRequestController@editprofile');
Route::post('like', 'Api\FavouriteController@like');
Route::post('unlike', 'Api\FavouriteController@unlike');
Route::get('wishlist', 'Api\FavouriteController@wishlist');
Route::post('createorders', 'Api\OrderController@createorders');
Route::get('logout',"Auth\Api\APILoginController@logout");
Route::post('addreview',"Api\ReviewsController@store");
Route::post('addcart',"Api\CartController@store");
Route::post('removeproductcart',"Api\CartController@deletefromcart");
Route::get('cart',"Api\CartController@index");
Route::get('getuser',"Auth\Api\APILoginController@getuser");
Route::get('notificationslist',"Api\NotificationController@index");



});

Route::group(['namespace' => 'Api'], function () {

Route::get('categories', 'CategoryController@categories');
Route::get('category', 'CategoryController@category');
Route::get('product', 'ProductController@productinfo');
Route::get('search', 'ProductController@search');
Route::get('page', 'PageController@page');
Route::get('governments', 'OrderController@governments');
Route::get('cities', 'OrderController@cities');

});
