<?php

use Illuminate\Support\Facades\Route;
use Modules\Rbac\App\Http\Controllers\NavigationManagementController;
use Modules\Rbac\App\Http\Controllers\PermissionManagementController;
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
        Route::get('create', [NavigationManagementController::class, 'create'])->name('create')->middleware('can:navigation-create');
        Route::get('edit/{comMenu}', [NavigationManagementController::class, 'edit'])->name('edit')->middleware('can:navigation-edit');
    });
    
    /*
    |--------------------------------------------------------------------------
    | Permission Management
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'permission-management', 'as' => 'permission.'], function () {
        Route::get('/', [PermissionManagementController::class, 'index'])->name('index');
    });
    
    /*
    |--------------------------------------------------------------------------
    | Role Management
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'role-management', 'as' => 'role.'], function () {
        Route::get('/', [RoleManagementController::class, 'index'])->name('index');
        Route::get('create', [RoleManagementController::class, 'create'])->name('create')->middleware('can:role-create');
        Route::get('edit/{comRole}', [RoleManagementController::class, 'edit'])->name('edit')->middleware('can:role-edit');
    });
    
    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'user-management', 'as' => 'user.'], function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('index');
        Route::get('create', [UserManagementController::class, 'create'])->name('create')->middleware('can:user-create');
        Route::get('edit/{comUser}', [UserManagementController::class, 'edit'])->name('edit')->middleware('can:user-edit');
    });
});
