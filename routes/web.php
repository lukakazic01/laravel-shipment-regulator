<?php

use App\Http\Controllers\ShipmentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('shipments', ShipmentsController::class);
