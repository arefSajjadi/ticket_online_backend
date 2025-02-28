<?php

namespace App\Http\Resources;

use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Seat resource
 */
class SeatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->resource->id,
            'status' => $this->resource->status,
            'row'    => $this->resource->row,
            'column' => $this->resource->column,
            'cost'   => $this->resource->cost
        ];
    }
}
