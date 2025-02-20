<?php

namespace App\Http\Controllers\Auth;

use App\Enum\CacheEnum;
use App\Facades\SmsFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendOtpRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class SendOtp extends Controller
{
    public function __invoke(SendOtpRequest $request): JsonResponse
    {
        $key = CacheEnum::USER_OTP_ . $request->username;

        Cache::put($key, $otp = rand(1000, 9999));

        $lock = Cache::lock($key, 5);

        if ($lock->get()) {
            try {
                SmsFacade::send($request->username, 'otp', [
                    'token' => $otp
                ]);
            } finally {
                $lock->release();
            }
        } else {
            throw new Exception(trans('exception.already_sms_send'));
        }

        return parent::json(status: 204);
    }
}
