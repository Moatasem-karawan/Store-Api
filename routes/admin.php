<?php

use App\Http\Controllers\Admin\AddbyadminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\Get_ordersController;
use App\Http\Controllers\Admin\Products\productsController;
use App\Http\Controllers\Admin\OffersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Notification\Admin\NotificationController as noti_controller_admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. No
w create something great!
|
*/
/**sms ads**/
Route::get("index/get/ads/sms",[noti_controller_admin::class,"get_sms_ads"])->name("sms_ads_orders");
Route::get("index/Accept/ads/sms/{id}",[noti_controller_admin::class,"accept_sms_ads_order"])->name("accept_sms_ads_order");


/**setting phones **/
Route::post("index/store_new_random_number",[noti_controller_admin::class,"store_new_random_number"])->name('store_new_random_number');

Route::post("index/send_free_sms_by_admin",[noti_controller_admin::class,"send_free_sms"])->name('send_free_sms_by_admin');

Route::get("index/send_sms_notification",[noti_controller_admin::class,"view_send_sms_notification"])->name('admin.send_sms_notification');

Route::post("index/store_free_number",[noti_controller_admin::class,"store_free_number"])->name('admin.store_free_number');

Route::post("index/edit_free_number/{id}",[noti_controller_admin::class,"edit_free_number"])->name('admin.edit_free_number');

Route::get("index/delete_free_number/{id}",[noti_controller_admin::class,"delete_free_number"])->name('admin.delete_free_number');


/**notification**/

Route::get("index/view/sms",[noti_controller_admin::class,"index"])->name('admin.view_sms');
Route::get("index/view-app/notification",[noti_controller_admin::class,"index"])->name("admin.view_app_notification");
Route::get('index/setting-sms',[noti_controller_admin::class,"index"])->name("admin.setting_sms");
/**end notification**/

/****************ajax**/
Route::post("index/admin/ajax/get/product/price",[OffersController::class,"ajax_get_product_price"])->name("ajax_get_product_price");


Route::post("index/admin/ajax/get/place_of_category",[CategoryController::class,"ajax_get_place_of_category"])->name("ajax_get_place_of_category");


/************************index view**********/
Route::get('/index',[AdminController::class,'view_index']);
Route::get('/index/show/products/explorer/{id_category}',[productsController::class,'get_explorer_products'])->name('show_all_products');
/***************category***************/
Route::get('/index/get/category',[CategoryController::class,'view_of_all']);
Route::post('/index/get/category',[CategoryController::class,'store_category'])->name('store_category');


/**place**/
/**delete placce*/
Route::get('/index/delete/seller_place/{id}',[PlaceController::class,'delete_seller_pace'])->name('delete_seller_pace');
Route::get('/index/delete/pool_place/{id}',[PlaceController::class,'delete_pool_pace'])->name('delete_pool_pace');

//*end delete*/
Route::get('/index/show/all/place/{id_category}',[PlaceController::class,'show_all_place_two_type'])->name('show_all_products_two_type');


Route::get('/index/place/seller/orders',[PlaceController::class,'seller_place_pending_place'])->name("seller_place_order");
Route::get('/index/place/pool/orders',[PlaceController::class,'pool_place_pending_place'])->name("pool_place_order");
Route::get('/index/place/accept/seller/place/{id_seller_place}',[PlaceController::class,'accept_seller_place'])->name("accept_seller_place");
/**end place
/***************pending/seller_product***************/
Route::get('/index/seller/pending/seller_product',[productsController::class,'pending_product_seller'])->name('pending_product_seller');


Route::get('/index/seller/show/seller/product/{id_seller_place}',[productsController::class,'show_seller_product'])->name('show_seller_product');



Route::get('/index/seller/place/accept/{id_order}',[productsController::class,'accept_seller_order'])->name('accept_seller_order');

Route::get('/index/place/seller/expire/{id_seller_place}',[PlaceController::class,'sleep_seller_place'])->name('sleep_seller_place');


Route::get('/index/pool/place/accept/{id_pool_place}',[PlaceController::class,'accept_pool_place'])->name('accept_pool_place');

Route::get('/index/place/pool/expire/{id_pool_place}',[PlaceController::class,'sleep_pool_place'])->name('sleep_pool_place');




Route::get('/index/pool/show/files/{id_pool_place}',[PlaceController::class,'show_pool_files'])->name('show_pool_files');
/****************************fqa**********************/
Route::get('/index/fqa',[AdminController::class,'fqa']);
Route::post('/index/fqa',[AdminController::class,'store_fqa'])->name('save_fqa');


/******adding admin side***/
 Route::get("index/add/pool/project",[AddbyadminController::class,"add_pool_view"])->name("add_pool_view");
Route::post("index/store/pool/project",[AddbyadminController::class,"add_pool"])->name("store_pool");


Route::get("index/add/seller/project",[AddbyadminController::class,"add_seller_view"])->name("add_seller_view");
Route::post("index/store/seller/project",[AddbyadminController::class,"store_seller_by_admin"])->name("store_seller_by_admin");
/******adding product for seller side by admin***/
Route::get("index/add/products/for/sellers/project",[AddbyadminController::class,"lest_seller_view"])->name("lest_seller_view");
Route::post("index/add/category/for/sellers/place",[AddbyadminController::class,"add_sub_category"])->name("add_sub_category_by_admin");

Route::get("index/add/products/for/sellers/place/{id_seller_place}",[AddbyadminController::class,"view_for_add_product"])->name("view_for_add_product");


Route::post("index/store/product/for/sellers/place",[AddbyadminController::class,"store_product_by_admin"])->name("store_product_by_admin");

/****************offers **/
Route::get("index/admin/make/code_offers",[OffersController::class,"code_offers_view"])->name("code_offers_view");
Route::post("index/admin/make/code_offers",[OffersController::class,"store_code_offers"])->name("store_code_offers");

Route::get("index/admin/get/pools/offers",[OffersController::class,"view_the_pools_offers"])->name("the_pools_offers");

Route::post("index/admin/ajax_get_period_price",[OffersController::class,"ajax_get_period_price"])->name("ajax_get_period_price");

Route::get("index/admin/view/pool-offer/temp/{pool_id}",[OffersController::class,"add_temp_pools_offers"])->name("add_temp_pools_offers");

Route::post("index/admin/store/pool/offers/by/admin",[OffersController::class,"store_offer_pool_by_admin"])->name('store_offer_pool_by_admin');



Route::get("index/admin/get/sellers/offers",[OffersController::class,"view_the_sellers_offers"])->name('the_sellers_offers');
Route::get("index/admin/view/sellers/offers/{id_seller_place}",[OffersController::class,"view_add_offer_by_admin"])->name('view_add_offer_by_admin_for_seller');
Route::post("index/admin/store/sellers/offers/by/admin",[OffersController::class,"store_offer_by_admin"])->name('store_offer_by_admin_for_seller');






/****admin.reservation*******/
Route::get("index/admin/get/reservation/pools",[Get_ordersController::class,"pool_reservation"])->name("admin.get.pool.reservation");

Route::get("index/admin/get/sellers_orders/orders/{today?}",[Get_ordersController::class,"sellers_orders"])->name("admin.get.sellers.orders");


Route::get("index/admin/delete_seller_offer_by_admin/{id_offer}",[OffersController::class,"delete_seller_offer_by_admin"])->name("delete_seller_offer_by_admin");
Route::get("index/admin/delete_pool_offer_by_admin/{id_offer}",[OffersController::class,"delete_pool_offer_by_admin"])->name("delete_pool_offer_by_admin");






