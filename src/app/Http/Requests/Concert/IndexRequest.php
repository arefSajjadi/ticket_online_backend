<?php

namespace App\Http\Requests\Concert;

use App\Http\Requests\BaseIndexRequest;
use App\Models\Order;

class IndexRequest extends BaseIndexRequest
{

    protected string $model = Order::class;

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'search' => 'nullable|string',
            'owner'  => 'nullable|bool',
        ]);
    }
}
