<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseAuthenticatedRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class Show extends Controller
{
    public function __invoke(BaseAuthenticatedRequest $request): JsonResponse
    {
        return parent::json(UserResource::make($request->user));
    }
}
