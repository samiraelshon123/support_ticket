<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth:web'])->group(function() {

    Route::resource('user', UserController::class);
    Route::resource('ticket', TicketController::class);
    Route::post('assign_agent/{id}', [TicketController::class, 'assign_agent'])->name('assign_agent');
    Route::post('add_comment/{id}', [TicketController::class, 'add_comment'])->name('add_comment');
    Route::resource('category', CategoryController::class);
    Route::resource('label', LabelController::class);
});

Auth::routes();


