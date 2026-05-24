<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [LoginController::class, 'login']);

Route::get('/blank', function () {
    return view('blank');
})->name('blank');
