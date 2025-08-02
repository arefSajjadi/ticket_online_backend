<?php

namespace App\Http\Resources;

use App\Models\Concert;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Concert resource
 */
class ConcertResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->resource->id,
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
            'date'       => $this->resource->date?->toDateTimeString(),
            'cost'       => $this->resource->cost,
            'status'     => $this->resource->status,
            'title'      => $this->resource->title,
            'capacity'   => $this->resource->capacity,
            'reserve'    => $this->resource->reserve,
            'remaining'  => $this->resource->remaining,
            'address'    => $this->resource->address,
            'file'       => $this->resource->file
        ];
    }
}
