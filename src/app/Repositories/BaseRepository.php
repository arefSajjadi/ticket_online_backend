<?php

namespace App\Repositories;

use App\Models\BaseModel;

abstract class BaseRepository
{
    public string $model = BaseModel::class;

    public function getModel(): BaseModel
    {
        return new $this->model();
    }
}
