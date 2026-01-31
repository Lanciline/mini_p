<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Properties
Route::middleware(['web'])->group(function () {
    Route::get('/properties', [App\Http\Controllers\PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/{property}', [App\Http\Controllers\PropertyController::class, 'show'])->name('properties.show');

    Route::middleware('auth')->group(function () {
        Route::post('/properties', [App\Http\Controllers\PropertyController::class, 'store'])->name('properties.store');
        Route::put('/properties/{property}', [App\Http\Controllers\PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/properties/{property}', [App\Http\Controllers\PropertyController::class, 'destroy'])->name('properties.destroy');

        Route::post('/reservations', [App\Http\Controllers\ReservationController::class, 'store'])->name('reservations.store');
        Route::get('/my/reservations', [App\Http\Controllers\ReservationController::class, 'index'])->name('reservations.index');

        Route::post('/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    });
});

// Admin review moderation
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/reviews', [App\Http\Controllers\Admin\ReviewAdminController::class, 'index'])->name('admin.reviews.index');
    Route::post('/reviews/{review}/approve', [App\Http\Controllers\Admin\ReviewAdminController::class, 'approve'])->name('admin.reviews.approve');
    Route::post('/reviews/{review}/reject', [App\Http\Controllers\Admin\ReviewAdminController::class, 'reject'])->name('admin.reviews.reject');
});


