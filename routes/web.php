<?php

use App\Http\Controllers\ShipmentsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');

Route::livewire('/profile', 'pages::profile')->middleware('auth')->name('profile.index');

Route::name('admin.')->prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::livewire('/', 'pages::admin.profile')->name('index');
        Route::livewire('{user}/edit', 'pages::admin.profile.edit')->name('edit');
    });
});

Route::patch('/shipments/{shipment}/assign-trucker', [ShipmentsController::class, 'assignTrucker'])->name('shipments.assign-trucker');

Route::resource('shipments', ShipmentsController::class);
