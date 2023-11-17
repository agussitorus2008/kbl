<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\ScheduleController;
use Spatie\Permission\Contracts\Role;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// AUTH
Route::name('auth.')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

// DRIVER RESOURCE API
Route::apiResource('drivers', DriverController::class)->only(['index', 'show']);
// CAR RESOURCE API
Route::apiResource('cars', CarController::class)->only(['index', 'show']);
// SCHEDULE RESOURCE API
Route::apiResource('schedules', ScheduleController::class)->only(['index', 'show']);
// AGENT RESOURCE API
Route::apiResource('agents', AgentController::class)->only(['index', 'show']);
// ORDER RESOURCE API
Route::apiResource('orders', OrderController::class)->only(['index', 'show']);
// COUPON RESOURCE API
Route::apiResource('coupons', CouponController::class)->only(['index', 'show']);

// CHAT API
Route::get('chats', [ChatController::class, 'index'])->name('chats.index');
Route::get('chats/{id}', [ChatController::class, 'show'])->name('chats.show');
Route::post('chats/store', [ChatController::class, 'store'])->name('chats.store');

// CHECKOUT API
Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');
Route::post('checkout/coupon', [CheckoutController::class, 'check_coupon'])->name('checkout.coupon');
Route::post('checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
