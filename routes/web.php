<?php

use App\Http\Controllers\Auth\LdapAuth\LdapAuthController;
use App\Http\Controllers\DashboardController;
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

// Athentication
Route::get('in/login', [LdapAuthController::class, 'create'])
    ->name('login')
    ->middleware('guest');
Route::post('in/login', [LdapAuthController::class, 'store'])
    ->name('login.store')->middleware('guest');

Route::delete('logout', [LdapAuthController::class, 'destroy'])
    ->name('logout');


Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');