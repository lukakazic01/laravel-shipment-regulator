<?php

use App\Http\Controllers\ShipmentsController;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home')->name('home');

Route::livewire('/profile', 'pages::profile')->middleware('auth')->name('profile.index');

Route::name('admin.')->prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::livewire('/', 'pages::admin.profile')->name('index');
        Route::livewire('{user}/edit', 'pages::admin.profile.edit')->name('edit');
    });
});

Route::patch('/shipments/{shipment}/assign-trucker', [ShipmentsController::class, 'assignTrucker'])->name('shipments.assign-trucker');

Route::name("shipments.")->prefix("/shipments")->group(function () {
    Route::livewire("/", "pages::shipments")->name('index');
    Route::livewire('/{shipment}', "pages::shipments.show")->name('show')->can('view', 'shipment');
    Route::get('/create', [ShipmentsController::class, 'create'])->name('create');
    Route::get('/{shipment}/edit', [ShipmentsController::class, 'edit'])->name('edit');
    Route::patch('/{shipment}', [ShipmentsController::class, 'update'])->name('update');
    Route::patch('/{shipment}/assign-trucker', [ShipmentsController::class, 'assignTrucker'])->name('assign-trucker');
});
