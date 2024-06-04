<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/entrar', function () {
    return view('auth.login');
})->name('login');

Route::get('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/cadastrar', function () {
    return view('auth.register');
})->name('register');

Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
