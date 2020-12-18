<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('payments', [PaymentController::class, 'index']);
Route::get('payments/create', [PaymentController::class, 'create'])->name('payment.create');
Route::post('payments', [PaymentController::class, 'store'])->name('payment.store');
Route::delete('payments-delete/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');
