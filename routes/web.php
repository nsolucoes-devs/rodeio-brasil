<?php

use App\Classes\Assas;
use App\Http\Controllers\Assas\AssasController;
use App\Http\Controllers\Assas\AssasWebhookController;
use App\Http\Controllers\CandidatesController;
use App\Models\FailsPayments;
use App\Project\HistoryPaymentLinks\Services\HistoryPaymentLinksService;
use App\Project\Subscriptions\Services\SubscriptionService;
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

Route::get('/candidatos', [CandidatesController::class, 'index'])->name('candidates');
Route::get('/candidatos/{code}', [CandidatesController::class, 'show'])->name('candidates.show');
Route::post('/vote', [CandidatesController::class, 'makeVote'])->name('vote');
Route::post('/generatePaymentLink', [AssasController::class, 'generatePaymentLink'])->name('generatePaymentLink');

// Webhook
Route::post('/webhook/assas', [AssasWebhookController::class, 'payment'])->name('webhook');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');



