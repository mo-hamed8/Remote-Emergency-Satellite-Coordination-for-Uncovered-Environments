<?php

use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\Api\SearchCaseController;
use App\Http\Controllers\api\SearchImageController;
use App\Http\Controllers\api\ProfileController;
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

Route::get("SearchImage",[SearchImageController::class,"index"])->middleware('auth:sanctum');
Route::post("imageAnalyses",[SearchImageController::class,"analyse"])->middleware('auth:sanctum');

Route::get("profile",[ProfileController::class,"index"])->middleware('auth:sanctum');

Route::get("suspectedImages",[SearchImageController::class,"suspectedImages"])->middleware('auth:sanctum');
