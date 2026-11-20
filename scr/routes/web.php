<?php

use App\Http\Controllers\AiChatController;
use App\Http\Controllers\MemberAiChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/contact', 'contact')->name('contact');

Route::get('/ai-chat/session', [AiChatController::class, 'show'])
    ->name('ai-chat.session');
Route::post('/ai-chat/messages', [AiChatController::class, 'store'])
    ->middleware('throttle:30,1')
    ->name('ai-chat.messages.store');

Route::get('/login', fn () => redirect()->route('home'))
    ->name('login');

Route::middleware('auth')->prefix('mypage')->name('mypage.')->group(function () {
    Route::get('/ai-consultations', [MemberAiChatController::class, 'index'])
        ->name('ai-consultations.index');
    Route::get('/ai-consultations/{chatSession}', [MemberAiChatController::class, 'show'])
        ->name('ai-consultations.show');
});
