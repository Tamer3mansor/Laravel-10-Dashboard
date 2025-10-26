<?php

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RolesController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

Route::group([
    'middleware' => ['auth:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'as' => 'admin.',
    'prefix' => LaravelLocalization::setLocale() . '/admin',
], function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // Roles Management Routes
    Route::resource('roles', RolesController::class)->names('roles');
    
    // Admins Management Routes
    Route::resource('admins', AdminsController::class);
});