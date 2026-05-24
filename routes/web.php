<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Helpers\AuthHelper;
use App\Http\Middleware\ApiTokenValidator;

Route::get('/', function () {
    if (AuthHelper::hasValidToken(request())) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [LoginController::class, 'login']);

Route::get('/signup', function () {
    return view('auth.signup');
})->name('signup');

Route::post('/signup', [SignupController::class, 'signup']);

Route::middleware(ApiTokenValidator::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});
