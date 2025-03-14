<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseAuthenticatedRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;

class Show extends Controller
{
    public function __invoke($id, BaseAuthenticatedRequest $request): JsonResponse
    {
        $order = $request->user->orders()->findOrFail($id);

        return parent::json(OrderResource::make($order));
    }
}
