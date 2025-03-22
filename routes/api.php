<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(
        [
            'middleware' => 'auth:sanctum',
            'namespace' => 'App\Http\Controllers\Contractors',
            'prefix' => 'contractors',
        ],
        function () {
            Route::get('/show', ShowController::class);
            Route::post('/create', CreateController::class);
        }
);
