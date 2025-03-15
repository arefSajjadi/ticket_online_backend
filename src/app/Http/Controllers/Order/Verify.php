<?php

namespace App\Http\Controllers\Order;

use App\Enum\OrderEnum;
use App\Enum\SeatEnum;
use App\Facades\OrderFacade;
use App\Facades\ParsianIpgFacade;
use App\Facades\SmsFacade;
use App\Facades\SystemEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseAuthenticatedRequest;
use App\Models\Seat;
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
                throw new Exception('FAIL_TO_VERIFY_PAYMENT');
            }

            ParsianIpgFacade::callbackValidation($order, $request->all());

            ParsianIpgFacade::verifyPayment($request->all());

            $order->update([
                'status' => OrderEnum::PAID_STATUS
            ]);

            foreach ($order->items as $item) {
                if ($item->itemable instanceof Seat) {
                    $item->itemable->update([
                        'status' => SeatEnum::RESERVE_STATUS
                    ]);
                }
            }

            SmsFacade::send($order->user->username, 'clientorderpaid', [
                'token' => $order->id
            ]);

            foreach (SystemEnum::ADMIN_NUMBERS as $number) {
                SmsFacade::send($number, 'adminorderpaid', [
                    'token'  => $order->id,
                    'token2' => now()->toDateString() . ' ساعت ' . now()->toTimeString()
                ]);
            }
        } catch (Exception $e) {
            Log::error('FAIL_TO_VERIFY_ORDER: ' . ($order->id ?? null), [$e->getMessage()]);

            if (empty($order)) {
                return response()->redirectTo(config('app.website'));
            }

            $order->update([
                'status' => OrderEnum::UNPAID_STATUS
            ]);
        }

        return response()->redirectTo(config('app.website') . "/order/$order->id");
    }
}
