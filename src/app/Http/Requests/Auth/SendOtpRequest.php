<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SendOtpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:11'
        ];
    }
}
