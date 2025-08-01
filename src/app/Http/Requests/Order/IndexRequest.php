<?php

namespace App\Http\Requests\Order;

use App\Enums\OrderEnum;
use App\Http\Requests\BaseIndexRequest;
use App\Models\Order;
use Illuminate\Validation\Rule;

/**
 * @property mixed status
 * @property mixed user_id
 */
class IndexRequest extends BaseIndexRequest
{

    protected string $model = Order::class;

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'status' => 'nullable|string|' . Rule::in([OrderEnum::PAID_STATUS, OrderEnum::UNPAID_STATUS])
        ]);
    }
}
