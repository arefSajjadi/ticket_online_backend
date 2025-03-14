<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use SoapClient;


class ParsianIpgService extends BaseService
{
    public function getToken(Order $order): string
    {
        $amount = $order->total * 10;

        $client = new SoapClient('https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?WSDL');

        try {
            $result = $client->SalePaymentRequest(['requestData' => ['LoginAccount' => config('gateway.parsian.pin'), 'Amount'       => $amount, 'OrderId'      => rand(), 'CallBackUrl'  => sprintf(config('gateway.callback_url'), $order->id)]]);
        } catch (Exception) {
            throw new Exception('fail_to_get_token');
        }


        if ($result?->SalePaymentRequestResult?->Status === 0 and !empty($result?->SalePaymentRequestResult?->Token)) {
            $token = $result->SalePaymentRequestResult->Token;
        }

        if (empty($token)) {
            throw new Exception('fail_to_get_token');
        }

        return 'https://pec.shaparak.ir/NewIPG/?Token=' . $token;
    }

    public function callbackValidation(Order $order, array $callbackData): void
    {
        if ($order->total <= 0) {
            throw new Exception('fail_to_verify_payment');
        }

        if (empty($callbackData['OrderId']) or empty($callbackData['Token'])) {
            throw new Exception('fail_to_verify_payment');
        }

        if ($callbackData['RRN'] <= 0 and $callbackData['status'] != 0) {
            throw new Exception('fail_to_verify_payment');
        }
    }

    public function verifyPayment(array $callbackData): void
    {
        if (empty($callbackData['Token'])) {
            throw new Exception('fail_to_verify_payment');
        }

        $client = new SoapClient('https://pec.shaparak.ir/NewIPGServices/Confirm/ConfirmService.asmx?WSDL');

        try {
            $result = $client->ConfirmPayment([
                'requestData' => [
                    'LoginAccount' => config('gateway.parsian.pin'),
                    'Token'        => $callbackData['Token'],
                ]
            ]);
        } catch (Exception) {
            throw new Exception('fail_to_verify_payment');
        }

        if ($result->ConfirmPaymentResult->Status != '0') {
            throw new Exception('fail_to_verify_payment');
        }
    }
}
