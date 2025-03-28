<?php

namespace App\Facades;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin UserRepository
 */
class UserFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UserRepository::class;
    }
}
