<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public string $model = Order::class;

    public function getModel(): Order
    {
        return new $this->model();
    }
}
