<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return parent::json(UserResource::make($request->user));
    }
}
