<?php

namespace App\Facades;

use App\Repositories\OrderItemRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin OrderItemRepository
 */
class OrderItemFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return OrderItemRepository::class;
    }
}
