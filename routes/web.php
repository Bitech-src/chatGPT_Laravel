<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ResolveController;

Route::get('/chat', [ChatController::class, 'index'])->name('chat_gpt-index');
Route::post('/chat', [ChatController::class, 'chat'])->name('chat_gpt-chat');
Route::get('/sample', [ChatController::class, 'sample']);
Route::get('/', function () {
    return view('welcome');
  });


