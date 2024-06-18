<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SigninController;
use App\Http\Controllers\Api\SignupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

// Open Routes
Route::post("register",[SignupController::class,"register"],"register");
Route::post("login",[SigninController::class,"login"],"login");

// Protected Routes
Route::group([
    "middleware"=>["auth:api"]
], function(){

    Route::post("buy-product",[ProductController::class,"buyProduct"],"buyProduct");
    Route::post("logout",[SigninController::class,"logout"],"logout");

});