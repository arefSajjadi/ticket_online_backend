<?php

namespace App\Facades;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin OrderRepository
 */
class OrderFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return OrderRepository::class;
    }
}
