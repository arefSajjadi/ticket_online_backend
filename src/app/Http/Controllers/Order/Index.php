<?php

namespace App\Http\Controllers\Order;

use App\Facades\OrderFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\IndexRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;

class Index extends Controller
{
    public function __invoke(IndexRequest $request): JsonResponse
    {
        $request->user_id = $request->user->id;

        $data = OrderFacade::index($request, OrderResource::class);

        return parent::json($data);
    }
}
