<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Middleware\ApiTokenValidator;
use App\Http\Controllers\Documents\DocumentController;
use App\Http\Controllers\Conversations\ConversationsController;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

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

    Route::get('/chat/{conversationId?}', [ConversationsController::class, 'chat'])->name('chat');
    Route::delete('/chat/{conversationId}/clean', [ConversationsController::class, 'clean'])->name('chat.clean');
    Route::post('/documents/upload', [DocumentController::class, 'upload'])->name('documents.upload');
    Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    Route::get('/chat/{conversationId}', [ConversationsController::class, 'show'])->name('chat.show');
    Route::post('/chat/{conversationId}/ask', [ConversationsController::class, 'ask'])->name('chat.ask');
});
