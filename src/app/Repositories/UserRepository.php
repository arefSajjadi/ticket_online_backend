<?php

namespace App\Repositories;

use App\Enums\UserEnum;
use App\Models\User;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository
{
    public string $model = User::class;

    public function getModel(): User
    {
        return new $this->model();
    }

    public function login($username): User
    {
        if (!empty($user = User::firstWhere('username', $username))) {
            $token = $user->token;
        }

        if (empty($token)) {
            $token = Str::random(64);
        }

        return $this->model::updateOrCreate([
            'username' => $username
        ], [
            'last_login' => now(),
            'status'     => UserEnum::ACTIVE_STATUS,
            'username'   => $username,
            'token'      => $token
        ]);
    }

    public function getUserWithToken(string|null $token): User|null
    {
        if (!empty($token)) {
            return $this->model::firstWhere('token', '=', $token);
        }
        return null;
    }
}
