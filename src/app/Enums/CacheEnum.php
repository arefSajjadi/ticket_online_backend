<?php


namespace App\Enums;

enum CacheEnum: string
{
    const ADMIN_TOKEN = 'admin_token_';
    const USER_TOKEN = 'user_token_';
    const ADMIN_TOKEN_TTL = 86400;
    const USER_OTP_ = 'user_otp_';
}
