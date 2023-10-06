<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\CarController;
use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\AgentController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DriverController;
use App\Http\Controllers\Backend\ScheduleController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\NotificationController;

Route::name('backend.')->group(function () {
    Route::redirect('/', 'dashboard', 301);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // DRIVER
    Route::resource('drivers', DriverController::class);

    // CAR
    Route::resource('cars', CarController::class);

    // SCHEDULE
    Route::resource('schedules', ScheduleController::class);

    // AGENT
    Route::resource('agents', AgentController::class);
    // ORDER
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('orders/approve/{order}', [OrderController::class, 'approve'])->name('orders.approve');
    Route::patch('orders/reject/{order}', [OrderController::class, 'reject'])->name('orders.reject');

    // COUPON
    Route::resource('coupons', CouponController::class);

    // PROFILE
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('index');
        Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
        Route::post('cpassword', [ProfileController::class, 'cpassword'])->name('cpassword');
        Route::post('save', [ProfileController::class, 'save'])->name('save');
    });

    // Notification
    Route::get('counter', [NotificationController::class, 'counter'])->name('counter_notif');
    Route::get('notification', [NotificationController::class, 'index'])->name('notification');

    // CHAT
    Route::get('chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('chats/{id}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('chats/store', [ChatController::class, 'store'])->name('chats.store');

    Route::get('logout', [AuthController::class, 'do_logout'])->name('logout');
});
