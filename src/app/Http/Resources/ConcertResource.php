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
            'date'       => $this->resource->date?->toDateString(),
            'time'       => $this->resource->date?->toTimeString(),
            'status'     => $this->resource->status,
            'title'      => $this->resource->title,
            'capacity'   => $this->resource->capacity,
            'delicate'   => $this->resource->delicate,
            'address'    => $this->resource->address,
            'file'       => $this->resource->file
        ];
    }
}
