<?php

use Illuminate\Support\Facades\Route;
use Modules\Rbac\App\Http\Controllers\NavigationManagementController;
use Modules\Rbac\App\Http\Controllers\RoleManagementController;
use Modules\Rbac\App\Http\Controllers\UserManagementController;

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

Route::group(['middleware' => ['auth'], 'prefix' => 'rbac', 'as' => 'rbac.'], function () {
    Route::view('account', 'rbac::pages.account.index')->name('account');
    
    /*
    |--------------------------------------------------------------------------
    | Navigation Management
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'navigation-management', 'as' => 'nav.'], function () {
        Route::get('/', [NavigationManagementController::class, 'index'])->name('index');
        Route::get('create', [NavigationManagementController::class, 'create'])->name('create');
        Route::get('edit/{comMenu}', [NavigationManagementController::class, 'edit'])->name('edit');
    });
    
    /*
    |--------------------------------------------------------------------------
    | Role Management
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'role-management', 'as' => 'role.'], function () {
        Route::get('/', [RoleManagementController::class, 'index'])->name('index');
    });
    
    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'user-management', 'as' => 'user.'], function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('index');
    });
});
