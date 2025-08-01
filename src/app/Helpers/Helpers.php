<?php

function responseShape(bool $error, int $code, mixed $data, int $httpStatus): \Illuminate\Http\JsonResponse
{
    return response()->json([
        'error' => $error,
        'code'  => $code,
        'data'  => $data
    ], $httpStatus);
}

function getFillable(string|null $model): array
{
    if (empty($model)) {
        return [];
    }

    /** @var Model $model */
    $model = new $model();

    return array_unique(array_merge($model->getFillable(), [
        'id',
        'created_at',
        'updated_at'
    ]));
}
