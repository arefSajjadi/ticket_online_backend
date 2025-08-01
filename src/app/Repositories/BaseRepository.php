<?php

namespace App\Repositories;

use App\Http\Requests\BaseIndexRequest;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

abstract class BaseRepository
{
    public string $model = BaseModel::class;

    protected function index(BaseIndexRequest $request, mixed $resource = null): LengthAwarePaginator|SupportCollection
    {
        return $this->getModel()->all();
    }

    public function getModel(): BaseModel
    {
        return new $this->model();
    }


    protected static function queryMaker(Builder $query, BaseIndexRequest $request, mixed $resource = null): LengthAwarePaginator|SupportCollection
    {
        if ($request->sort) {
            $query->orderBy($request->sort, $request->direction);
        }

        if ($request->paginate) {
            $data = $query->paginate($request->per_page)->withPath('');

            if (!empty($resource)) {
                $data = $data->setCollection($data->getCollection()->mapInto($resource));
            }
        } else {
            $data = $query->get();

            if (!empty($resource)) {
                $data = $data->mapInto($resource);
            }
        }

        return $data;
    }
}
