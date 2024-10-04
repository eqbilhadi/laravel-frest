<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Testing\AddUser;
use Illuminate\Support\Facades\Route;
use Modules\Authentication\App\Models\ComUser;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    Route::get('/', HomeController::class)->name('home');
});