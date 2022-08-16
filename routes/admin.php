<?php

use Illuminate\Support\Facades\Route;

Route::group(['as'=>'admin.','middleware' => ['role:admin|creator','auth']], function () {

    Route::get('/','AdminDashboard@index')->name('dashboard');
    Route::resource('/tests',AdminTestsController::class);
    Route::get('/create-test-items/{slug}','AdminTestItemsController@create')->name('test-items.create');
    Route::resource('/test-items',AdminTestItemsController::class,['except' => ['create']]);

});