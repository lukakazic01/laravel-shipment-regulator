<?php

use App\Http\Controllers\ShipmentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('shipments', ShipmentsController::class);
