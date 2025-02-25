<?php

namespace App\Repositories;

use App\Models\Concert;

class ConcertRepository extends BaseRepository
{
    public string $model = Concert::class;

    public function getModel(): Concert
    {
        return new $this->model();
    }
}
