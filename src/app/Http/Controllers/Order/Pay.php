<?php

namespace App\Http\Controllers\Order;

use App\Enums\OrderEnum;
use App\Facades\ParsianIpgFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseAuthenticatedRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class Pay extends Controller
{
    public function __invoke($id, BaseAuthenticatedRequest $request): JsonResponse
    {
        $order = $request->user->orders()->findOrFail($id);

        if ($order->created_at->diffInHours(now()) > 24) {
            throw new Exception('ORDER_EXPIRED');
        }

        if ($order->status != OrderEnum::UNPAID_STATUS) {
            throw new Exception('ORDER_STATUS_INVALID');
        }

        if (true) {
            $url = config('app.url') . "/api/order/$order->id/fake-gateway";
        } else {
            $url = ParsianIpgFacade::getToken($order);
        }

        return parent::json([
            'redirect_url' => $url
        ]);
    }
}
