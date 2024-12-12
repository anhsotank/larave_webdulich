<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\OnepayController;
use App\Http\Controllers\MoMoController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexContoller;

Route::get('/', [IndexContoller::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//categories

Route::resource('/categories', CategoriesController::class);
Route::resource('/tour', TourController::class);
Route::resource('/onepay', OnepayController::class);
use App\Http\Controllers\PayPalController;

Route::get('/paypal/create', [PayPalController::class, 'createTransaction'])->name('paypal.create');
Route::get('/paypal/success', [PayPalController::class, 'successTransaction'])->name('paypal.success');
Route::get('/paypal/cancel', [PayPalController::class, 'cancelTransaction'])->name('paypal.cancel');
Route::get('/paypal/capture', [PayPalController::class, 'captureTransaction'])->name('paypal.capture');



