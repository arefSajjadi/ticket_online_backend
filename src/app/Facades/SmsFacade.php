<?php

namespace App\Facades;

use App\Services\KavehNegarService;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin KavehNegarService
 */
class SmsFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return KavehNegarService::class;
    }
}
