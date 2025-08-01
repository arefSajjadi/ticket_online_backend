<?php

namespace App\Http\Controllers\Order;

use App\Enums\OrderEnum;
use App\Facades\OrderFacade;
use App\Facades\ParsianIpgFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseAuthenticatedRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class Verify extends Controller
{
    public function __invoke($id, BaseAuthenticatedRequest $request): RedirectResponse
    {
        try {
            $order = OrderFacade::getModel()->findOrFail($id);

            if ($order->status === OrderEnum::PAID_STATUS) {
                throw new Exception('order_already_paid');
            }

            if (!$request->exists('fake_gateway')) {
                ParsianIpgFacade::callbackValidation($order, $request->all());

                ParsianIpgFacade::verifyPayment($request->all());
            }

            OrderFacade::paidProcess($order);
        } catch (Exception $e) {
            Log::error('FAIL_TO_VERIFY_ORDER: ' . ($order->id ?? null), [$e->getMessage()]);

            if (empty($order)) {
                return response()->redirectTo(config('app.website'));
            }

            $order->update([
                'status' => OrderEnum::UNPAID_STATUS
            ]);
        }

        return response()->redirectTo(config('app.website') . "/order/$order->id/payment-status");
    }
}
