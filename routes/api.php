<?php

use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\Api\SearchCaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("register",[AuthenticationController::class,"register"]);
Route::post("login",[AuthenticationController::class,"login"]);
Route::post("logout",[AuthenticationController::class,"logout"])->middleware('auth:sanctum');

Route::get("search-case",[SearchCaseController::class,"index"]);
Route::post("search-case",[SearchCaseController::class,"store"])->middleware('auth:sanctum');
