<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CheckoutRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;

class Show extends Controller
{
    public function __invoke($id, CheckoutRequest $request): JsonResponse
    {
		$order = $request->user->orders()->findOrFail($id);

        return parent::json(OrderResource::make($order));
    }
}
