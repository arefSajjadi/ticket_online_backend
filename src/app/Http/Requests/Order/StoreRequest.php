<?php

namespace App\Http\Requests\Order;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed seat_ids
 * @property User user
 */
class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'seat_ids'   => 'required|array',
            'seat_ids.*' => 'required|numeric|exists:seats,id'
        ];
    }
}
