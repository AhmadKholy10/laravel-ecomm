<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function(){

    ########   Guest routes #########
    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
        Route::view('/login', 'back.pages.admin.auth.login')->name('login');
        Route::post('/do-login', [AdminController::class,'login'])->name('do-login');
        Route::view('/forgot-password','back.pages.admin.auth.forgot-password' )->name('forgot-password');
        Route::post('/send-password-reset-link',[AdminController::class,'sendPasswordReset'])
        ->name('send-password-reset');
        Route::get('/password/reset/{token}', [AdminController::class,'resetPassword'])
        ->name('reset-password');
        Route::post('/password/reset',[AdminController::class,'doResetPassword'])->name('do-reset-password');
    });
    
    
    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('/home', 'back.pages.admin.home')->name('home');
        Route::view('/settings', 'back.pages.admin.settings')->name('settings');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

