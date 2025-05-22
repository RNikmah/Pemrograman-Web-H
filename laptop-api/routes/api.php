<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/laptop',  App\Http\Controllers\Api\LaptopController::class);
Route::apiResource('/category',  App\Http\Controllers\Api\CategoryController::class);