<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseAuthenticatedRequest;

class StoreRequest extends BaseAuthenticatedRequest
{
    public function rules(): array
    {
        return [
            'seat_ids'   => 'required|array',
            'seat_ids.*' => 'required|numeric|exists:seats,id'
        ];
    }
}
