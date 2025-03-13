<?php

namespace App\Facades;

use App\Repositories\SeatRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin SeatRepository
 */
class SeatFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SeatRepository::class;
    }
}
