<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\TheShops;
use App\Http\Controllers\Admin\Category;
use App\Http\Controllers\Admin\Taste;
use App\Http\Controllers\Admin\all_sub_category;
use App\Http\Controllers\Admin\SubCategory;
use App\Http\Controllers\Admin\Product;
use App\Http\Controllers\Admin\Slider;
use App\Http\Controllers\Admin\ShopDescription;
use App\Http\Controllers\Admin\ModeratorsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ModeratorShopController;
use App\Http\Controllers\Admin\ShopCOntroller;
use App\Http\Controllers\Admin\ModeratorDeliveriController;
use Illuminate\Support\Facades\Route;

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

//
Route::get('/', function () {
    if(auth()->check()){
        return redirect()->route('HomePage');
    }else{
        return redirect()->route('login');

    }
});


Route::get('NoAuth' , function (){
    return response()->json([
        'status'=>false,
        'message' =>  'no auth user'
        ,
    ],422);
})->name('NoAuth');


Route::get('/login', [AdminLoginController::class, 'login'])->name('login');

Route::prefix('admin')->group(function () {
    Route::middleware(['NoAuthUser'])->group(function () {

        Route::post('/logined', [AdminLoginController::class, 'logined'])->name('logined');
        Route::get('/forgotGetPage', [AdminLoginController::class, 'forgotGetPage'])->name('forgotGetPage');
        Route::post('send_email_code_from_admin', [AdminLoginController::class,'send_email_code_from_admin'])->name('send_email_code_from_admin');
        Route::post('FrogotPasswordAddNewPasswordRequest', [AdminLoginController::class,'FrogotPasswordAddNewPasswordRequest'])->name('FrogotPasswordAddNewPasswordRequest');
    });



    Route::middleware(['AuthUser'])->group(function () {
    Route::get('HomePage', [AdminLoginController::class,'HomePage'])->name('HomePage');
    Route::get('logoutAdmin', [AdminLoginController::class,'logoutAdmin'])->name('logoutAdmin');
    Route::get('settingView', [AdminLoginController::class, 'settingView'])->name('settingView');
    Route::post('updatePassword', [AdminLoginController::class, 'updatePassword'])->name('updatePassword');

            Route::middleware(['SuperAdmin'])->group(function (){
                Route::get('all_moderators',[ModeratorsController::class, 'all_moderators'])->name('all_moderators');
                Route::get('new_moderator', [ModeratorsController::class, 'new_moderator'])->name('new_moderator');
                Route::post('add_new_moderator', [ModeratorsController::class, 'add_new_moderator'])->name('add_new_moderator');
                Route::get('single_page_moderator/moderator_id={id}', [ModeratorsController::class, 'single_page_moderator'])->name('single_page_moderator');
                Route::post('update_moderator', [ModeratorsController::class, 'update_moderator'])->name('update_moderator');
                Route::get('delete_moderator/moderator_id={id}',[ModeratorsController::class, 'delete_moderator'])->name('delete_moderator');

                Route::get('all_users', [UsersController::class, 'all_users'])->name('all_users');
                Route::get('app_user_single_page/user_id={id}', [UsersController::class, 'app_user_single_page'])->name('app_user_single_page');
                Route::get('success_register/user_id={id}', [UsersController::class, 'success_register'])->name('success_register');
                Route::get('search_user', [UsersController::class, 'search_user'])->name('search_user');
                Route::post('add_bonuse_from_user', [UsersController::class, 'add_bonuse_from_user'])->name('add_bonuse_from_user');


                Route::get('ShopDescription', [ShopDescription::class, 'ShopDescription'])->name('ShopDescription');
                Route::post('update_shop_description', [ShopDescription::class, 'update_shop_description'])->name('update_shop_description');

                Route::get('all_slider',[Slider::class , 'all_slider'])->name('all_slider');
                Route::get('new_slider',[Slider::class , 'new_slider'])->name('new_slider');
                Route::post('create_slider',[Slider::class , 'create_slider'])->name('create_slider');
                Route::get('single_page_slider/slider_id={id}',[Slider::class , 'single_page_slider'])->name('single_page_slider');
                Route::post('update_slider',[Slider::class , 'update_slider'])->name('update_slider');
                Route::get('close_slider/slider_id={id}',[Slider::class , 'close_slider'])->name('close_slider');
                Route::get('open_slider/slider_id={id}',[Slider::class , 'open_slider'])->name('open_slider');


                Route::get('the_shops',[TheShops::class , 'the_shops'])->name('the_shops');
                Route::get('new_shop/{id?}',[TheShops::class, 'new_shop'])->name('new_shop');
                Route::post('add_new_shop',[TheShops::class, 'add_new_shop'])->name('add_new_shop');
                Route::get('single_page_user/user_id={id}',[TheShops::class, 'single_page_user'])->name('single_page_user');
                Route::post('update_user_admin',[TheShops::class, 'update_user_admin'])->name('update_user_admin');

                Route::get('category/{id?}',[Category::class, 'category'])->name('category');
                Route::get('new_category/',[Category::class, 'new_category'])->name('new_category');
                Route::post('add_new_category',[Category::class, 'add_new_category'])->name('add_new_category');
                Route::post('update_category',[Category::class, 'update_category'])->name('update_category');
                Route::get('delete_category/category_id={id}',[Category::class, 'delete_category'])->name('delete_category');


                Route::get('all_sub', [SubCategory::class, 'all_sub_category'])->name('all_sub_category');
                Route::get('new_sub_category', [SubCategory::class, 'new_sub_category'])->name('new_sub_category');
                Route::post('add_new_sub_category', [SubCategory::class, 'add_new_sub_category'])->name('add_new_sub_category');
                Route::get('single_page_sub_category/sub_id={id}', [SubCategory::class, 'single_page_sub_category'])->name('single_page_sub_category');
                Route::post('update_sub_category', [SubCategory::class, 'update_sub_category'])->name('update_sub_category');
                Route::get('delete_category_id_from_made_in/{id}/{made_id}', [SubCategory::class, 'delete_category_id_from_made_in'])->name('delete_category_id_from_made_in');
                Route::get('delete_sub_category/{id}',[SubCategory::class,'delete_sub_category'])->name('delete_sub_category');

                Route::get('all_taste', [Taste::class, 'all_taste'])->name('all_taste');
                Route::get('delete_taste/{id}', [Taste::class, 'delete_taste'])->name('delete_taste');
                Route::get('search_all_taste', [Taste::class, 'search_all_taste'])->name('search_all_taste');
                Route::get('new_all_taste', [Taste::class, 'new_all_taste'])->name('new_all_taste');
                Route::post('add_new_taste', [Taste::class, 'add_new_taste'])->name('add_new_taste');
                Route::get('single_page_taste/{id}', [Taste::class, 'single_page_taste'])->name('single_page_taste');
                Route::post('update_taste', [Taste::class, 'update_taste'])->name('update_taste');
                Route::get('delete_made_in_from_taste/{id}/{taste_id}', [Taste::class, 'delete_made_in_from_taste'])->name('delete_made_in_from_taste');
                Route::get('delete_category_from_taste/{id}/{taste_id}', [Taste::class, 'delete_category_from_taste'])->name('delete_category_from_taste');




            });

        Route::middleware(['Moderator'])->group(function (){

            Route::get('all_users', [UsersController::class, 'all_users'])->name('all_users');
            Route::get('app_user_single_page/user_id={id}', [UsersController::class, 'app_user_single_page'])->name('app_user_single_page');
            Route::get('success_register/user_id={id}', [UsersController::class, 'success_register'])->name('success_register');
            Route::get('search_user', [UsersController::class, 'search_user'])->name('search_user');
            Route::post('add_bonuse_from_user', [UsersController::class, 'add_bonuse_from_user'])->name('add_bonuse_from_user');

            Route::get('new_shops',[ModeratorShopController::class, 'new_shops'])->name('new_shops');
            Route::get('old_shops',[ModeratorShopController::class, 'old_shops'])->name('old_shops');
            Route::get('single_new_shop/shop_id={id}',[ModeratorShopController::class,'single_new_shop'])->name('single_new_shop');
            Route::get('success_new_shop/shop_id={id}',[ModeratorShopController::class,'success_new_shop'])->name('success_new_shop');

            Route::get('new_delivery',[ModeratorDeliveriController::class,'new_delivery'])->name('new_delivery');
            Route::get('single_delivery/delivery_id={id}',[ModeratorDeliveriController::class,'single_delivery'])->name('single_delivery');
            Route::get('delivery_delivery',[ModeratorDeliveriController::class,'delivery_delivery'])->name('delivery_delivery');
            Route::get('delivers_delivery',[ModeratorDeliveriController::class,'delivers_delivery'])->name('delivers_delivery');
            Route::get('confirmed_delivery',[ModeratorDeliveriController::class,'confirmed_delivery'])->name('confirmed_delivery');

            Route::get('deliveryd/{id}',[ModeratorDeliveriController::class,'deliveryd'])->name('deliveryd');
        });


        Route::get('NewDelivery', [ShopCOntroller::class, 'NewDelivery'])->name('NewDelivery');
        Route::get('DeliveryDeliverys', [ShopCOntroller::class, 'DeliveryDelivery'])->name('DeliveryDelivery');
        Route::get('ConfirmedDeliveryDelivery', [ShopCOntroller::class, 'ConfirmedDeliveryDelivery'])->name('ConfirmedDeliveryDelivery');
        Route::get('SingleNewDelivery/{id}', [ShopCOntroller::class, 'SingleNewDelivery'])->name('SingleNewDelivery');

        Route::get('ShowNewShop',[ShopCOntroller::class,'ShowNewShop'])->name('ShowNewShop');
        Route::get('ShowOldShop',[ShopCOntroller::class,'ShowOldShop'])->name('ShowOldShop');
        Route::get('ShowNewShopDetails/shop_id={id}',[ShopCOntroller::class,'ShowNewShopDetails'])->name('ShowNewShopDetails');
        Route::get('ShowNewShopDetailSuccess/shop_id={id}',[ShopCOntroller::class,'ShowNewShopDetailSuccess'])->name('ShowNewShopDetailSuccess');

            Route::get('products', [Product::class, 'products'])->name('products');
            Route::get('search_product', [Product::class, 'search_product'])->name('search_product');
            Route::get('close_product', [Product::class, 'close_product'])->name('close_product');
            Route::get('add_product', [Product::class, 'add_product'])->name('add_product');
            Route::post('create_product', [Product::class, 'create_product'])->name('create_product');
            Route::get('product_page/product_id={id}', [Product::class, 'product_page'])->name('product_page');
            Route::post('update_product', [Product::class, 'update_product'])->name('update_product');
            Route::get('delete_photo_product/photo_id={id}', [Product::class, 'delete_photo_product'])->name('delete_photo_product');
            Route::get('close_shop/product_id={id}', [Product::class, 'close_shop'])->name('close_shop');
            Route::get('open_shop/product_id={id}', [Product::class, 'open_shop'])->name('open_shop');

    });
});

