<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KavehNegarService extends BaseService
{
    private mixed $apiKey;
    private mixed $url;

    public function __construct()
    {
        $this->apiKey = config('credential.sms.api_key');
        $this->url = "https://api.kavenegar.com/v1/$this->apiKey/verify/lookup.json";
    }

    public function send(int $receptor, string $template, array|null $body = null): void
    {
        $body = array_merge([
            'template' => $template,
            'receptor' => $receptor
        ], $body);


        try {
            $response = Http::get($this->url, $body);

            if ($response->status() != 200) {
                throw new Exception(trans('exception.already_sms_send'));
            }
        } catch (\Exception $e) {
            Log::error("fail to send `$template` sms to `$receptor`", [$e->getMessage()]);
        }
    }
}
