<?php

namespace App\Repositories;

use App\Enum\UserEnum;
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
        $token = Str::random(64);

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
