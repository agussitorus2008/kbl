<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ScheduleController;
use App\Http\Controllers\Frontend\NotificationController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::post('schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::get('schedule/{schedule}', [ScheduleController::class, 'show'])->name('schedule.show');
Route::get('auth', [AuthController::class, 'login'])->name('auth.login');
Route::get('auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('auth/forgot', [AuthController::class, 'forgot'])->name('auth.forgot');
Route::get('about', fn () => view('pages.frontend.about.index'))->name('about');

// Route::prefix('auth')->name('auth.')->group(function () {
//     Route::post('login', [AuthController::class, 'do_login'])->name('login');
//     Route::post('register', [AuthController::class, 'do_register'])->name('register');
// });

Route::middleware(['auth', 'role:customer'])->group(function () {
    // PROFILE
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('profile', [ProfileController::class, 'update_profile'])->name('update_profile');
    Route::get('cpassword', [ProfileController::class, 'cpassword'])->name('cpassword');
    Route::post('cpassword', [ProfileController::class, 'do_cpassword'])->name('cpassword');
    Route::post('save', [ProfileController::class, 'save'])->name('save');
    Route::get('card', [ProfileController::class, 'card'])->name('card');
    Route::post('card', [ProfileController::class, 'update_card'])->name('update_card');

    // SCHEDULE
    Route::post('schedule/{schedule}', [ScheduleController::class, 'create'])->name('schedule.input');
    Route::get('schedule/seats/{schedule}', [ScheduleController::class, 'seats'])->name('schedule.seats');
    Route::get('schedule/confirm', [ScheduleController::class, 'confirm'])->name('schedule.confirm');

    // CHECKOUT
    Route::post('confirm', [CheckoutController::class, 'confirm'])->name('confirm');
    Route::post('confirm/coupon', [CheckoutController::class, 'check_coupon'])->name('confirm.coupon');
    Route::post('confirm/payment', [CheckoutController::class, 'payment'])->name('confirm.payment');
    Route::post('checkout', [CheckoutController::class, 'do_checkout'])->name('checkout');

    // ORDER
    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::get('order/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::patch('order/{order}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');

    // COUPON
    Route::get('coupon', [CouponController::class, 'index'])->name('coupon.index');

    // NOTIFICATION
    Route::get('counter', [NotificationController::class, 'counter'])->name('counter_notif');
    Route::get('notification', [NotificationController::class, 'index'])->name('notification');

    // CHAT
    Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('chat', [ChatController::class, 'store'])->name('chat.send');

    Route::get('logout', [AuthController::class, 'do_logout'])->name('auth.logout');
});
