<?php

use Illuminate\Support\Facades\Route;

Route::get('{page}', App\Http\Controllers\InitController::class)->where('page', '.*');
