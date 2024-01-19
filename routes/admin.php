<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
        Route::view('/login', 'back.pages.admin.auth.login')->name('login');
        Route::post('/do-login', [AdminController::class,'login'])->name('do-login');
    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('/home', 'back.pages.admin.home')->name('home');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

