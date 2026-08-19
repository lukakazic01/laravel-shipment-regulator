<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');

Route::livewire('/profile', 'pages::profile')->middleware('auth')->name('profile.index');

Route::controller(AdminProfileController::class)->name('admin.')->prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('{user}/edit', 'edit')->name('edit');
        Route::patch('{user}/updateRole', 'updateRole')->name('updateRole');
    });
});

Route::patch('/shipments/{shipment}/assign-trucker', [ShipmentsController::class, 'assignTrucker'])->name('shipments.assign-trucker');

Route::resource('shipments', ShipmentsController::class);
