<?php

use App\Http\Controllers\Testing\AddUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('default', 'default')->name('default');
    Route::view('profile', 'profile')->name('profile');
    Route::view('account', 'account')->name('account');
});




require __DIR__ . '/auth.php';
