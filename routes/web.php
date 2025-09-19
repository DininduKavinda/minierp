<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware(['guest']);

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware(['guest']);

Route::post('/login', [AuthController::class, 'postLogin'])->name('auth.login')->middleware(['guest']);

Route::post('/register', [AuthController::class, 'postRegister'])->name('auth.register')->middleware(['guest']);
