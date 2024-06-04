<?php

namespace App\Http\Controllers\Assas;

use App\Http\Controllers\Controller;
use App\Models\FailsPayments;
use App\Project\HistoryPaymentLinks\Services\HistoryPaymentLinksService;
use App\Project\Subscriptions\Services\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AssasWebhookController extends Controller
{
    public function payment(Request $request) {
        $webhook = $request->all();

        if($webhook['event'] == 'PAYMENT_RECEIVED'){
            
            if($webhook['payment']['status'] !== 'RECEIVED'){
                return;
            }

            try {
                $getCPFOfPayment = (new HistoryPaymentLinksService())->getRepository()->findOneWhere([
                    'paymentLink' => $webhook['payment']['paymentLink']
                ]);
            
                if(!$getCPFOfPayment){
                    return;
                }
            
                $subscription = new SubscriptionService();
                $alreadySubscribed = $subscription->validateIfAlreadySubscribed($getCPFOfPayment->cpf);
            
                if($alreadySubscribed) {
                    return 'Já é assinante';
                }
            
                $subscription->save(['cpf' => $getCPFOfPayment->cpf]);
            
                return 'Assinatura realizada com sucesso!';
            } catch (\Throwable $th) {
        
                FailsPayments::create([
                    'paymentLink' => $webhook['payment']['paymentLink']
                ]);
        
                return 'Falha ao realizar assinatura';
            }
        }
    }
}
