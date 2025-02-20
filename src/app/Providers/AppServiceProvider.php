<?php

namespace App\Providers;

use App\Services\KavehNegarService;
use App\Services\UserService;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KavehNegarService::class, KavehNegarService::class);
        $this->app->singleton(UserService::class, UserService::class);
    }

    public function boot(): void
    {
        Carbon::serializeUsing(function (Carbon $carbon) {
            return $carbon->toDateTimeString();
        });
    }
}
