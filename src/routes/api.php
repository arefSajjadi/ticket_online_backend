<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\SendOtp;
use App\Http\Controllers\User\Show as ShowUser;
use App\Http\Middleware\UserAuthenticate;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(static function () {
    Route::post('/otp', SendOtp::class);
    Route::post('/login', Login::class);
});

Route::middleware(UserAuthenticate::class)->group(static function () {
    Route::prefix('user')->group(static function () {
        Route::get('/', ShowUser::class);
    });
});
