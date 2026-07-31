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

Route::patch('/shipments/{shipment}/assign-trucker', [ShipmentsController::class, 'assignTrucker'])->name('shipments.assign-trucker');

Route::resource('shipments', ShipmentsController::class);
