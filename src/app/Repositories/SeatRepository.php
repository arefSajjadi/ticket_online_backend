<?php

namespace App\Repositories;

use App\Models\Seat;

class SeatRepository extends BaseRepository
{
    public string $model = Seat::class;

    public function getModel(): Seat
    {
        return new $this->model();
    }

    public function availability(Seat $seat): bool
    {
        return !($seat->orderItems()->whereHas('order', function ($query) {
            return $query->paid();
        })->exists());
    }
}
