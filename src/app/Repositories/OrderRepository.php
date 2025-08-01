<?php

namespace App\Repositories;

use App\Enums\OrderEnum;
use App\Enums\SeatEnum;
use App\Enums\SystemEnum;
use App\Facades\SmsFacade;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Requests\Order\IndexRequest;
use App\Models\Order;
use App\Models\Seat;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

class OrderRepository extends BaseRepository
{
    public string $model = Order::class;

    public function index(BaseIndexRequest|IndexRequest $request, mixed $resource = null): LengthAwarePaginator|SupportCollection
    {
        $query = $this->getModel()->query();

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        return parent::queryMaker($query, $request, $resource);
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
