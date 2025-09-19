<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/login', [AuthController::class, 'postLogin'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('auth.register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('Home');

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::resource('products', ProductController::class);
});
