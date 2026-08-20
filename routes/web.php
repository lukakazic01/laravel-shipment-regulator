<?php

use App\Http\Controllers\ShipmentsController;
use App\Models\Shipment;
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
    Route::livewire('/create', 'pages::shipments.create')->name('create')->can('view-create-shipment-page', Shipment::class);
    Route::livewire('/{shipment}', "pages::shipments.show")->name('show')->can('view', 'shipment');
    Route::get('/{shipment}/edit', [ShipmentsController::class, 'edit'])->name('edit');
    Route::patch('/{shipment}', [ShipmentsController::class, 'update'])->name('update');
    Route::patch('/{shipment}/assign-trucker', [ShipmentsController::class, 'assignTrucker'])->name('assign-trucker');
});
