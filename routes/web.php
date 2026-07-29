<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::controller(ProfileController::class)->name('profile.')->prefix('/profile')->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::put('/', 'changeAvatar')->name('change-avatar');
});

Route::resource('shipments', ShipmentsController::class);
