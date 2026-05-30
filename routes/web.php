<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Helpers\AuthHelper;
use App\Http\Middleware\ApiTokenValidator;
use App\Http\Controllers\Documents\DocumentController;

Route::get('/', function () {
    if (AuthHelper::hasValidToken(request())) {
        return redirect()->route('home');
    }
    return view('auth.login');
})->name('login');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/signup', function () {
    return view('auth.signup');
})->name('signup');

Route::post('/signup', [SignupController::class, 'signup']);

Route::middleware(ApiTokenValidator::class)->group(function () {
    Route::get('/home', [DocumentController::class, 'index'])->name('home');

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('/chat', [DocumentController::class, 'chat'])->name('chat');
    Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');
});
