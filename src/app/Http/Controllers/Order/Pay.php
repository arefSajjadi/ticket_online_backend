<?php

namespace App\Http\Controllers\Order;

use App\Enum\OrderEnum;
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

        if (now()->diffInHours($order->created_at) > 24) {
            throw new Exception('ORDER_EXPIRED');
        }

        if ($order->status != OrderEnum::UNPAID_STATUS) {
            throw new Exception('ORDER_STATUS_INVALID');
        }

        $url = ParsianIpgFacade::getToken($order);

        return parent::json([
            'redirect_url' => $url
        ]);
    }
}
