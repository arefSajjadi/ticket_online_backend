<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Concert\IndexRequest;
use Illuminate\Http\JsonResponse;

class Index extends Controller
{
    public function __invoke(IndexRequest $request): JsonResponse
    {
        return parent::json([]);
    }
}
