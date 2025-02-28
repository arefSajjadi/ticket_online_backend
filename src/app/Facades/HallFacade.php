<?php

namespace App\Facades;

use App\Repositories\HallRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin HallRepository
 */
class HallFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return HallRepository::class;
    }
}
