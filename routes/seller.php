<?php


use App\Http\Controllers\Seller\Orders_sellerController;
use App\Http\Controllers\Seller\productController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\OffersController;
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

Route::get("/seller",[SellerController::class,"index"])->name("index_seller");
Route::get("/seller/place",[SellerController::class,"view_add_place"])->name('add_place');
Route::post("/seller/place/store",[SellerController::class,"store_place"])->name('store_place');

Route::post("/seller/seller_product/store",[productController::class,"store_product"])->name('store_product');

Route::post("/seller/change/state-place",[SellerController::class,"change_state_place"])->name('change_state_place');

Route::get("/seller/show-my-products",[productController::class,"show_my_products"])->name('show_my_products');

Route::get("/seller/delete-my-products/{id_product}",[productController::class,"delete_my_products"])->name('delete_my_products');

Route::get("/seller/order/done/{id_order}",[Orders_sellerController::class,"order_done"])->name('order_done');
Route::get("/seller/order/order_backed_off/{id_order}",[Orders_sellerController::class,"order_backed_off"])->name('order_backed_off');
Route::post("/seller/store_sub_seller_category",[productController::class,"add_sub_category"])->name('store_sub_seller_category');
Route::get("/seller/delete_sub_seller_category/{id_sub_category}",[productController::class,"delete_sub_category"])->name('delete_sub_category');



//**codes**/
Route::get("/seller/show-my-codes",[OffersController::class,"show_my_codes"])->name('seller_show_my_codes');
//Route::get();
Route::post("/seller/store-code",[OffersController::class,"store_code_offers_by_seller"])->name('store_code_offers_by_seller');
/**stting**/
Route::get("/seller/setting",[SellerController::class,"show_my_setting"])->name('my_setting');
