<?php

namespace App\Facades;

use App\Repositories\ConcertRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin ConcertRepository
 */
class ConcertFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ConcertRepository::class;
    }
}
