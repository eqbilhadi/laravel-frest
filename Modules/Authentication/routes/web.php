<?php

use Illuminate\Support\Facades\Route;
use Modules\Authentication\App\Http\Controllers\VerifyEmailController;

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

Route::middleware('guest')->group(function () {
    Route::get('register', fn () => view('authentication::pages.register'))
        ->name('register');

    Route::get('login', fn () => view('authentication::pages.login'))
        ->name('login');

    Route::get('forgot-password', fn () => view('authentication::pages.forgot-password'))
        ->name('password.request');

    Route::get('reset-password/{token}', fn () => view('authentication::pages.reset-password'))
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', fn () => view('authentication::pages.verify-email'))
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::get('confirm-password', fn () => view('authentication::pages.confirm-password'))
        ->name('password.confirm');
});

