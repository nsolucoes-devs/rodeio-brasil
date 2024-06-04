<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

// Main Page Route
Route::prefix('admin')->middleware(['auth'])
    ->namespace('Admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
});


