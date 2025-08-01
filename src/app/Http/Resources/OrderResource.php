<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Order resource
 */
class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $items = $this->resource->items;

        return [
            'id'         => $this->resource->id,
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'paid_at'  => $this->resource->updated_at->toDateTimeString(),
            'total'      => $this->resource->total,
            'status'     => $this->resource->status,
            'concert'    => ConcertResource::make($items->first()?->itemable?->hall?->concert),
            'items'      => $items->sortBy(function ($item) {
                return [$item->itemable->row, $item->itemable->column];
            })->map(function ($item) {
                return [
                    'id'   => $item->id,
                    'cost' => $item->cost,
                    'seat' => SeatResource::make($item->itemable)
                ];
            })->values(),
        ];
    }
}
