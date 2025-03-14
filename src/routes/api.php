<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\SendOtp;
use App\Http\Controllers\Concert\Hall\Show as ShowHall;
use App\Http\Controllers\Concert\Index as IndexConcert;
use App\Http\Controllers\Concert\Show as ShowConcert;
use App\Http\Controllers\Order\Pay as PayOrder;
use App\Http\Controllers\Order\Show as ShowOrder;
use App\Http\Controllers\Order\Store as StoreOrder;
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

    Route::prefix('order')->group(static function () {
        Route::get('/{id}', ShowOrder::class);
        Route::post('/{id}/pay', PayOrder::class);
        Route::post('/', StoreOrder::class);
    });
});


Route::prefix('concert')->group(static function () {
    Route::prefix('{id}/hall')->group(static function () {
        Route::get('/', ShowHall::class);
    });

    Route::get('/', IndexConcert::class);
    Route::get('/{id}', ShowConcert::class);
});
