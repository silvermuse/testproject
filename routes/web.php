<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PasswordGeneratorController;
use App\Http\Controllers\PizzaOrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/password-generator', [PasswordGeneratorController::class, 'index'])->name('password.generator');
Route::post('/password-generator/generate', [PasswordGeneratorController::class, 'generate'])->name('password.generate');

Route::get('/pizza-order', [PizzaOrderController::class, 'index'])->name('pizza.order');
Route::post('/pizza-order/bill', [PizzaOrderController::class, 'calculateBill'])->name('pizza.bill');