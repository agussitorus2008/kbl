<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\ChatController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ScheduleController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Frontend\NotificationController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::post('schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::get('schedule/{schedule}', [ScheduleController::class, 'show'])->name('schedule.show');
Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::match(['get', 'post'], 'forgot', [AuthController::class, 'forgot'])->name('forgot')->middleware('guest');
Route::get('/email/verify', function () {
    if (Auth::user()->email_verified_at == null) {
        return view('pages.auth.verify');
    } else {
        return redirect()->route('dashboard');
    }
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return view('pages.auth.welcome');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    // check session apakah sudah 5 menit
    if (session('last_email_sent') && now()->diffInMinutes(session('last_email_sent')) < 5) {
        return response()->json([
            'status' => 'error',
            'message' => 'Please wait 5 minutes before requesting another email.',
        ]);
    }

    $request->user()->sendEmailVerificationNotification();

    return response()->json([
        'status' => 'success',
        'message' => 'Verification email sent.',
    ]);
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('password/reset/{token}', [AuthController::class, 'reset'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'do_reset'])->name('password.do_reset');
Route::get('password/change', [AuthController::class, 'change'])->name('password.change');
Route::get('about', fn () => view('pages.frontend.about.index'))->name('about');
Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);

Route::middleware(['auth', 'verified', 'role:customer'])->group(function () {
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
    Route::get('payment/{order}', [CheckoutController::class, 'payment'])->name('payment');
    Route::get('success/{order}', [CheckoutController::class, 'success'])->name('success');
    Route::get('invoice/{order}', [CheckoutController::class, 'invoice'])->name('invoice');


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

    Route::get('logout', [AuthController::class, 'do_logout'])->name('logout');
});
