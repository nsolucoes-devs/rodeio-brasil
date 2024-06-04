<?php 

namespace App\Classes;

use GuzzleHttp\Exception\GuzzleException;

class Assas {
    public function generatePaymentLink(String $cpf)
    {
        $payload = [
            "billingType" => "PIX",
            "description" => $cpf,
            "chargeType" => "INSTALLMENT",
            "name" => "12",
            "value" => 5.99,
            "dueDateLimitDays" => 1,
            "maxInstallmentCount" => 1
        ];

        try {
            $client = new \GuzzleHttp\Client();
            $URL = 'https://sandbox.asaas.com/api/v3/paymentLinks';
    
            $response = $client->request('POST', $URL, [
                'body' => json_encode($payload),
                'headers' => [
                  'accept' => 'application/json',
                  'access_token' => env('ASSAS_TOKEN'),
                  'content-type' => 'application/json',
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return response()->json([
                'url' => $data['url']
            ], 200);

        } catch (GuzzleException $e) {
            throw new \Exception($e->getMessage());
        }
    
    }
}