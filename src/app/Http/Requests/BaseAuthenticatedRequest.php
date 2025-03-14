<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property User user
 */
class BaseAuthenticatedRequest extends FormRequest
{
}
