<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\informationController;
use App\Http\Controllers\Api\orders\Seller_ordersController;
use App\Http\Controllers\Api\poolControlller;
use App\Http\Controllers\Api\sellerController;
use App\Http\Controllers\Api\orders\Pool_ordersController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\Save_byController;
use App\Http\Controllers\Api\Traders\TradersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Api" middleware group. Enjoy building your API!
|
*/


Route::get('/categories',[informationController::class,'get_categories']);
Route::any('/filtering/data',[informationController::class,'filtering_data']);

Route::post('/who_iam',[informationController::class,'who_iam']);

/**Route::get('/randomly/seller_product',[informationController::class,'get_random_products']);**/

Route::get('/get/all_place_of_category/{id_category}',[informationController::class,'get_place_of_category']);



Route::get('/show/seller_place/{id_seller_place}',[sellerController::class,'show_seller_place_information']);

Route::post('/seller_place/show/specific/product',[sellerController::class,'specific_product']);



Route::get('/show/pool_place/{id_pool_place}',[poolControlller::class,'show_pool_place_information']);


Route::get('/get/pool/place/of/offers',[OfferController::class,'get_pool_place_of_offers']);
Route::get('/show/pool/place/of/offer/{id_of_pool}',[OfferController::class,'show_pool_place_of_offer']);


Route::get('/get/sellers/offers',[OfferController::class,'get_seller_place_of_offers']);

Route::get('/get/seller/place/offer/{id_seller_place}',[OfferController::class,'show_seller_place_of_offer']);



//Route::get('/get/sellers/offers',[informationController::class,'get_place_of_category']);


Route::post("/whatsapp/msg",[informationController::class,"whats_msg"]);

Route::get('/get/FQA',[informationController::class,'get_fqa']);



/*****************orders***********/
Route::middleware(['jwt','Only_users','active_user'])->group(function () {
    Route::get('/get/user/information',[UserController::class,'get_my_information']);
Route::post('/edit/user/information',[UserController::class,'edit_user_information']);

Route::post('/make/order/for/seller',[Seller_ordersController::class,'make_seller_order']);
    Route::post('/make/offer-order/for/seller',[Seller_ordersController::class,'make_offer_seller_order']);
    Route::post('/delete/seller/order/{id_order}',[Seller_ordersController::class,'delete_seller_order']);




    Route::post('/make/order/for/pool',[Pool_ordersController::class,'make_pool_order']);


Route::get('/delete/pool_order/{id_order}',[Pool_ordersController::class,'delete_pool_order']);


Route::post('/make/offer-order/for/pool',[Pool_ordersController::class,'make_pool_order_offer']);


Route::get('/user/get/my/seller/orders',[UserController::class,'get_my_seller_orders']);

Route::get('/user/get/my/pool/orders',[UserController::class,'get_my_pool_orders']);


    /**rating**/

    Route::post('/pool_place/make/rating',[RatingController::class,'make_rating_pool_place']);

    Route::post('/seller_place/make/rating',[RatingController::class,'make_rating_seller_place']);
    /**save post**/


    Route::post('/user/save/pool_place',[Save_byController::class,'save_pool_place']);
   Route::post('/user/save/seller_place',[Save_byController::class,'save_seller_place']);

    Route::post('/user/delete/save/pool_place',[Save_byController::class,'delete_save_pool_place']);
    Route::post('/user/delete/save/seller_place',[Save_byController::class,'delete_save_seller_place']);




    Route::get('/user/get/save/pool_place',[Save_byController::class,'get_save_pool_place']);

    Route::get('/user/get/save/seller_place',[Save_byController::class,'get_save_seller_place']);



    /**end save post**/

});




Route::middleware(['Api'])->group(function () {
    Route::post('/person/login',[AuthController::class,'login']);
    Route::post('/user/active/while-register',[AuthController::class,'active_user_while_register']);


    Route::post('/person/register',[AuthController::class,'register']);


    Route::post('/user/me',[AuthController::class,'me']);
    Route::post('/user/logout',[AuthController::class,'logout']);

});


Route::middleware(['jwt','Only_sellers'])->group(function () {

Route::post('/trader/register/project',[TradersController::class,'register_project_for_traders']);
    Route::post('/trader/get/project/information',[TradersController::class,'get_project_information']);


    Route::post('/trader/create/category',[TradersController::class,'create_category']);
    Route::post('/trader/create/product',[TradersController::class,'create_product']);

    Route::get('/trader/get/category',[TradersController::class,'get_category']);
    Route::get('/trader/get/product',[TradersController::class,'get_product']);



    Route::post('/trader/create/offer/code',[TradersController::class,'create_offer_code']);

Route::get("/trader/show/offers-codes",[TradersController::class,"show_offer_code"])->name('seller_show_my_codes');

Route::get('/trader/delete/offer/code/{id_offer}',[TradersController::class,'delete_offer_code']);
    Route::any('/trader/register/sms/ads/order',[\App\Http\Controllers\Api\Traders\AdsController::class,'sms_ads']);
    Route::any('/trader/sms/ads/orders',[\App\Http\Controllers\Api\Traders\AdsController::class,'sms_ads_orders']);


    Route::get('/trader/edit/ads/{id}',[TradersController::class,'delete_offer_code']);



});



