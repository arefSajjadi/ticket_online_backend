<?php

namespace App\Providers;

use App\Repositories\ConcertRepository;
use App\Repositories\HallRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\SeatRepository;
use App\Repositories\UserRepository;
use App\Services\KavehNegarService;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->repositories();

        $this->services();
    }

    public function boot(): void
    {
        Carbon::serializeUsing(function (Carbon $carbon) {
            return $carbon->toDateTimeString();
        });
    }

    public function repositories(): void
    {
        $this->app->singleton(UserRepository::class, UserRepository::class);
        $this->app->singleton(ConcertRepository::class, ConcertRepository::class);
        $this->app->singleton(HallRepository::class, HallRepository::class);
        $this->app->singleton(OrderRepository::class, OrderRepository::class);
        $this->app->singleton(OrderItemRepository::class, OrderItemRepository::class);
        $this->app->singleton(SeatRepository::class, SeatRepository::class);
    }

    public function services(): void
    {
        $this->app->singleton(KavehNegarService::class, KavehNegarService::class);
    }
}
