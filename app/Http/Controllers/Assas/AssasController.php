<?php

namespace App\Http\Controllers\Assas;

use App\Http\Controllers\Controller;
use App\Project\HistoryPaymentLinks\Services\HistoryPaymentLinksService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class AssasController extends Controller
{
    public function generatePaymentLink(Request $request)
    {
        $payload = [
            "billingType" => "PIX",
            "description" => $request->input('cpf'),
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

            $historyPaymentLink = new HistoryPaymentLinksService();
            $historyPaymentLink->save([
                'cpf' => $request->input('cpf'),
                'paymentLink' => $data['id']
            ]);

            return response()->json([
                'url' => $data['url']
            ], 200);

        } catch (GuzzleException $e) {
            throw new \Exception($e->getMessage());
        }
    
    }
}
