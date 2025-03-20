<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('{page}', App\Http\Controllers\InitController::class)->where('page', '.*');
