<?php

namespace App\Repositories;

use App\Models\Hall;

class HallRepository extends BaseRepository
{
    public string $model = Hall::class;

    public function getModel(): Hall
    {
        return new $this->model();
    }
}
