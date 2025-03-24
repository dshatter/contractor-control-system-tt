<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::prefix('contractors')
    ->namespace('App\Http\Controllers\Contractors')
    ->middleware('auth:sanctum')
    ->group(function () {
            Route::post('/', StoreController::class);
            Route::get('/show', ShowController::class);
    });
