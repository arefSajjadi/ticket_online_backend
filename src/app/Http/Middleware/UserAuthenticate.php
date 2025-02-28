<?php

namespace App\Http\Middleware;

use App\Facades\UserFacade;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class UserAuthenticate
{
    public function handle(Request $request, Closure $next): mixed
    {
        $user = UserFacade::getUserWithToken($request->bearerToken());

        if (empty($user)) {
            throw new AuthenticationException;
        }

        $data = $request->all();
        $data['user'] = $user;
        $request->replace($data);

        return $next($request);
    }
}
