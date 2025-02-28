<?php

namespace App\Http\Resources;

use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Hall resource
 */
class HallResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->resource->id,
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
            'status'     => $this->resource->status,
            'name'       => $this->resource->name,
            'seats'      => $this->when($this->resource->seats()->exists(), function () {
                return SeatResource::collection($this->resource->seats);
            })
        ];
    }
}
