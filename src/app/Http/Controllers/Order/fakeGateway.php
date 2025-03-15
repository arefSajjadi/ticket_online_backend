<?php

namespace App\Http\Controllers\Order;

use App\Facades\OrderFacade;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class fakeGateway extends Controller
{
    public function __invoke($id)
    {
		$order = OrderFacade::getModel()->findOrFail($id);

        return view('gateway', [
			'order' => $order
        ]);
    }
}
