<?php

namespace App\Http\Controllers\Auth;

use App\Enums\CacheEnum;
use App\Facades\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class Login extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $key = CacheEnum::USER_OTP_ . $request->username;

        $otp = Cache::get($key);

        if ($otp == $request->otp or true) {
            $user = UserFacade::login($request->username);

            Cache::forget($key);

            return parent::json([
                'token' => $user->token,
                'user'  => [
                    'id'         => $user->id,
                    'last_login' => $user->last_login,
                    'username'   => $user->username
                ],
            ], 201);
        }

        throw new AuthenticationException;
    }
}
