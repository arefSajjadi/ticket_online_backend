<?php

namespace App\Services;

use App\Enum\UserEnum;
use App\Models\User;
use Illuminate\Support\Str;

class UserService extends BaseService
{
    public function login($username): User
    {
        $token = Str::random(64);

        return User::updateOrCreate([
            'username' => $username
        ], [
            'last_login' => now(),
            'status'     => UserEnum::ACTIVE_STATUS,
            'username' => $username,
            'token'      => $token
        ]);
    }

    public function getUserWithToken(string|null $token): User|null
    {
        if (!empty($token))
            return User::firstWhere('token', '=', $token);
        return null;
    }
}
