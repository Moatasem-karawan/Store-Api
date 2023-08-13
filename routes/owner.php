<?php


use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\Owner\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\MyPoolController;

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
Route::get("/owner",[OwnerController::class,"index"])->name("owner_index");
Route::get("/owner/add/place",[OwnerController::class,"view_add_product"])->name("owner_add_product");

Route::post("/owner/save/owner/place",[OwnerController::class,"store_product"]);



//Route::get("/owner/out-side/reservation-view",[ReservationController::class,"out_reservation_view"])->name("out-reservation-view");
Route::post("/owner/out-side/reservation-store",[ReservationController::class,"store_out_reservation"])->name("store_out-reservation");

Route::post("/owner/save/NEW/PERIOD",[MyPoolController::class,"new_period"])->name("new_period");
Route::get("/owner/owner/delete/my_period/{id_period}",[MyPoolController::class,"delete_my_period"])->name("delete_my_period");
try{
Route::post("/try",function(){
    return "werwer";
});} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
