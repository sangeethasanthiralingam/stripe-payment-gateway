<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StripeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::get('/charge', [PaymentController::class, 'showChargeForm'])->name('charge');
Route::post('/process-charge', [PaymentController::class, 'processCharge'])->name('process.charge');

Route::match(['get', 'post'], '/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');


Route::get('/stripe/customer/{customerId}', [StripeController::class, 'getCustomerDetails']);

Route::get('/add-customer', [CustomerController::class, 'showAddCustomerForm']);
Route::post('/add-customer', [CustomerController::class, 'addCustomer']);
Route::get('/get-all-customer', [CustomerController::class, 'getAllCustomer']);

