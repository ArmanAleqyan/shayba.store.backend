<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\V1\Registration;
use  App\Http\Controllers\Api\V1\Login;
use  App\Http\Controllers\Api\V1\Category;
use  App\Http\Controllers\Api\V1\Products;
use  App\Http\Controllers\Api\V1\Slider;
use  App\Http\Controllers\Api\V1\FiltreProduct;
use  App\Http\Controllers\Api\V1\Basket;
use  App\Http\Controllers\Api\V1\MyCabinet;
use  App\Http\Controllers\Api\V1\OrderController;
use  App\Http\Controllers\Api\V1\FavoriteProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('registration',[Registration::class, 'registration']);
Route::post('confirm_registration',[Registration::class, 'confirm_registration']);
Route::post('login',[Login::class, 'login']);

Route::post('forgot_password', [Login::class, 'forgot_password']);
Route::post('validation_forgot_password_code', [Login::class, 'validation_forgot_password_code']);
Route::post('add_new_password', [Login::class, 'add_new_password']);

Route::get('all_slider', [Slider::class,'all_slider']);
Route::get('get_category',[Category::class,'get_category']);
Route::get('get_all_taste',[Category::class,'get_all_taste']);
Route::get('get_all_made_in',[Category::class,'get_all_made_in']);
Route::get('get_shops',[Category::class,'get_shops']);

Route::post('filtered_product',[FiltreProduct::class,'filtered_product']);




Route::get('saite_header_and_footer_info', [Registration::class,'saite_header_and_footer_info']);

Route::get('all_products',[Products::class,'all_products']);
Route::get('single_page_product/product_id={id}',[Products::class,'single_page_product']);




Route::group(['middleware' => ['auth:api']], function () {
    Route::post('add_or_delete_in_favorite',[FavoriteProductController::class, 'add_or_delete_in_favorite']);
    Route::get('get_my_favorite', [FavoriteProductController::class, 'get_my_favorite']);

    Route::post('add_in_basket', [Basket::class, 'add_in_basket']);
    Route::post('get_my_basket', [Basket::class, 'get_my_basket']);
    Route::post('minus_basket_product', [Basket::class, 'minus_basket_product']);
    Route::post('delete_all_basket', [Basket::class, 'delete_all_basket']);




    Route::get('auth_user_info', [MyCabinet::class, 'auth_user_info']);
    Route::post('add_new_email', [MyCabinet::class, 'add_new_email']);
    Route::post('validation_email_condidate_code', [MyCabinet::class, 'validation_email_condidate_code']);
    Route::post('add_new_password2', [MyCabinet::class, 'add_new_password2']);
    Route::post('update_user_name', [MyCabinet::class, 'update_user_name']);


    Route::post('add_new_order', [OrderController::class,'add_new_order']);
    Route::get('my_orders_history', [OrderController::class, 'my_orders_history']);

});
Route::get('logout', [Login::class, 'logout']);
Route::post('user_feedback',[MyCabinet::class, 'user_feedback']);
