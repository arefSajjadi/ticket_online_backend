<?php

namespace App\Http\Controllers\Concert\Hall;

use App\Facades\ConcertFacade;
use App\Http\Controllers\Controller;
use App\Http\Resources\HallResource;
use Illuminate\Http\JsonResponse;

class Show extends Controller
{
    public function __invoke(mixed $id): JsonResponse
    {
        $concert = ConcertFacade::getModel()->findOrFail($id);

        return parent::json($concert->hall ? HallResource::make($concert->hall) : []);
    }
}
