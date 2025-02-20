<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|numeric|min:11',
            'otp'    => 'required|string|min:4|max:4'
        ];
    }
}
