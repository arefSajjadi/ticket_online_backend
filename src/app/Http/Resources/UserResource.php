<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property User resource
 */
class UserResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id'         => $this->resource->id,
			'created_at' => $this->resource->created_at->toDateTimeString(),
			'updated_at' => $this->resource->updated_at->toDateTimeString(),
			'last_login' => $this->resource->last_login?->toDateTimeString(),
			'username'   => $this->resource->username
		];
	}
}
