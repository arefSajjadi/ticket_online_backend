<?php

namespace App\Http\Controllers\Concert;

use App\Facades\ConcertFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Concert\IndexRequest;
use App\Http\Resources\ConcertResource;
use Illuminate\Http\JsonResponse;

class Index extends Controller
{
    public function __invoke(IndexRequest $request): JsonResponse
    {
        $concert = ConcertFacade::getModel();

        $data = $concert::all()->mapInto(ConcertResource::class);

        return parent::json($data);
    }
}
