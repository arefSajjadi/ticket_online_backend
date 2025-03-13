<?php

namespace App\Http\Requests\Order;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property User user
 */
class CheckoutRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
