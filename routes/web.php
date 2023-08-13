<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\filesController;
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
//URL::forceScheme('https');


Route::redirect('/', 'login', 301);
Route::get('/login',[AuthController::class,"view_login"])->name("login")->middleware('guest');
Route::post('/login',[AuthController::class,"do_login"])->name('do_login');

Route::get('/register',[AuthController::class,"register"])->name("register");
Route::post('/register',[AuthController::class,"do_register"])->name("do_register");
Route::get("/logout",[AuthController::class,"logout"])->name('logout');

Route::post("/upload_files_from_owner",[filesController::class,"upload_files_from_owner"])->middleware("throttle:3,1")->name("file_pond");

Route::get("/test",function (){
    \Illuminate\Support\Facades\Mail::to("MoatasemKaron99@gmail.com")->send(new \App\Mail\testMail());
    echo "done";
});