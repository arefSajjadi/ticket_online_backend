<?php

namespace App\Repositories;

use App\Enum\OrderEnum;
use App\Enum\SeatEnum;
use App\Facades\SmsFacade;
use App\Facades\SystemEnum;
use App\Models\Order;
use App\Models\Seat;

class OrderRepository extends BaseRepository
{
    public string $model = Order::class;

    public function getModel(): Order
    {
        return new $this->model();
    }

    public function paidProcess(Order $order): void
    {
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
    }
}
