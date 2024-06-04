<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::get('/sobre', function () {
    return view('public.about');
})->name('about');

Route::get('/contato', function () {
    return view('public.contact');
})->name('contact');

Route::get('/candidados', function () {
    return view('public.candidates.index');
})->name('candidates');

Route::get('/candidados/{code}/{slug?}', function ($code) {
    return view('public.candidates.show', ['code' => $code]);
})->name('candidates.show');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');



