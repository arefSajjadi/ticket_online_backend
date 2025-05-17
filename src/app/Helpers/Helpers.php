<?php

function responseShape(bool $error, int $code, mixed $data, int $httpStatus): \Illuminate\Http\JsonResponse
{
    return response()->json([
        'error' => $error,
        'code'  => $code,
        'data'  => $data
    ], $httpStatus);
}
