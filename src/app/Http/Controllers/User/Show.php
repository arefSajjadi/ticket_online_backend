<?php

namespace App\Http\Controllers\User;

use App\Enum\CacheEnum;
use App\Facades\SmsFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendOtpRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Show extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return parent::json(UserResource::make($request->user));
    }
}
