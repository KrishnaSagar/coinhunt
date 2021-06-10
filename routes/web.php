<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;

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

Route::get('/', function () {
    return view('welcome');
});

// Kontrol et !!!
Route::get("/admin/login",[AuthController::class,"login"]);
Route::post("/admin/login",[AuthController::class,"login_post"]);

Route::prefix("/admin")->middleware("isAdmin")->group(function(){

    Route::get("/logout",[AuthController::class,"logout"]);

    Route::prefix("/coins")->group(function (){
        Route::get("/",[CoinController::class,"index"]);
        Route::get("/create",[CoinController::class,"create"]);
        Route::post("/",[CoinController::class,"store"]);
        Route::get("/{id}/edit",[CoinController::class,"edit"]);
        Route::put("/{id}",[CoinController::class,"update"]);
        Route::delete("/{id}",[CoinController::class,"destroy"]);
    });

    Route::prefix("/categories")->group(function(){
        Route::get("/",[CategoryController::class,"index"]);
        Route::get("/create",[CategoryController::class,"create"]);
        Route::post("/",[CategoryController::class,"store"]);
        Route::get("/{id}/edit",[CategoryController::class,"edit"]);
        Route::put("/{id}",[CategoryController::class,"update"]);
        Route::delete("/{id}",[CategoryController::class,"destroy"]);
    });

    Route::prefix("/articles")->group(function(){
        Route::get("/",[ArticleController::class,"index"]);
        Route::get("/create",[ArticleController::class,"create"]);
        Route::post("/",[ArticleController::class,"store"]);
        Route::get("/{id}/edit",[ArticleController::class,"edit"]);
        Route::put("/{id}",[ArticleController::class,"update"]);
        Route::delete("/{id}",[ArticleController::class,"destroy"]);
    });

});
