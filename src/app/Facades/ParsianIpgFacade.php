<?php

namespace App\Facades;

use App\Services\ParsianIpgService;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin ParsianIpgService
 */
class ParsianIpgFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ParsianIpgService::class;
    }
}
