<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('front.home');


Route::middleware(['App\Http\Middleware\setfactor'])->group(function () {

    Route::get('{language}/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('front.home.language');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

