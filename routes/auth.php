<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth\ConfirmPassword;
use App\Livewire\Auth\VerifyEmail;
use Illuminate\Support\Facades\Route;

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
// Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

// Temporary redirect to login instead of register
Route::redirect('/register', '/login')->name('register');

// Password Reset Routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request')->middleware('guest');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('guest');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset')->middleware('guest');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('verify-email', VerifyEmail::class)->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::get('confirm-password', ConfirmPassword::class)->name('password.confirm');
});

// Make sure to use our new LoginController for logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['namespace' => 'Auth', 'middleware' => 'guest'], function () {
    Route::get('login/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('social.login');
    Route::get('login/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('social.login.callback');
});
