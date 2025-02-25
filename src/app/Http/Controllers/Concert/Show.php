<?php

namespace App\Http\Controllers\Concert;

use App\Facades\ConcertFacade;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConcertResource;
use Illuminate\Http\JsonResponse;

class Show extends Controller
{
    public function __invoke(mixed $id): JsonResponse
    {
        $concert = ConcertFacade::getModel()->findOrFail($id);

        return parent::json(ConcertResource::make($concert));
    }
}
