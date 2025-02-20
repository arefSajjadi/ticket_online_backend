<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\SendOtp;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(static function () {
    Route::post('/otp', SendOtp::class);
    Route::post('/login', Login::class);
});
