<?php

namespace App\Http\Controllers\Order;

use App\Enums\OrderEnum;
use App\Facades\SeatFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class Store extends Controller
{
    public function __invoke(StoreRequest $request): JsonResponse
    {
        $order = $request->user->orders()->create([
            'status' => OrderEnum::UNPAID_STATUS
        ])->refresh();

        $request->seat_ids = array_unique($request->seat_ids);

        foreach ($request->seat_ids as $id) {
            $seat = SeatFacade::getModel()->find($id);

            if (!SeatFacade::availability($seat)) {
                throw new Exception(trans('exception.seat.seat_not_available', [
                    'row'    => $seat->row,
                    'column' => $seat->column
                ]));
            }

            $seats[] = $seat;

            $hallIndex = $seat->hall_id;
        }


        if (!empty($seats) and !empty($hallIndex)) {
            foreach ($seats as $seat) {
                if ($hallIndex != $seat->hall_id) {
                    throw new Exception(trans('exception.seat.seat_with_different_hall', [
                        'row'    => $seat->row,
                        'column' => $seat->column
                    ]));
                }
            }
        }


        if (!empty($seats)) {
            foreach ($seats as $seat) {
                $seat->orderItems()->create([
                    'order_id' => $order->id,
                    'cost'     => $seat->cost
                ]);
            }
        }

        return parent::json($order->only('id'), 201);
    }
}
