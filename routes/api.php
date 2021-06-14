<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'product'], function () {

    Route::get('/list/{id_product}',  [App\Http\Controllers\ProductsController::class, 'getById']);
    Route::get('/list',  [App\Http\Controllers\ProductsController::class, 'getAll']);
    Route::post('/create',  [App\Http\Controllers\ProductsController::class, 'create']);
    Route::post('/import',  [App\Http\Controllers\ProductsController::class, 'importExcel']);
    Route::put('/update',  [App\Http\Controllers\ProductsController::class, 'updateQuantity']);
    Route::delete('/delete/{id_product}',  [App\Http\Controllers\ProductsController::class, 'delete']);
});

Route::group(['prefix' => 'reserve'], function () {

    Route::get('/list',  [App\Http\Controllers\ReserveController::class, 'getAll']);
    Route::post('/create',  [App\Http\Controllers\ReserveController::class, 'create']);
    Route::delete('/delete/{id_reserve}',  [App\Http\Controllers\ReserveController::class, 'delete']);
});

Route::group(['prefix' => 'client'], function () {

    Route::get('/list',  [App\Http\Controllers\ClientController::class, 'getAll']);
    Route::post('/create',  [App\Http\Controllers\ClientController::class, 'create']);
    Route::delete('/delete/{id_client}',  [App\Http\Controllers\ClientController::class, 'delete']);
});
