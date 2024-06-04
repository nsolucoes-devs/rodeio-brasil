<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Models\Candidates;
use App\Project\Candidates\Service\CandidatesService;
use App\Project\Votes\Services\VoteService;
use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    public function index()
    {
        $candidatesService = new CandidatesService(); 
        $candidates = $candidatesService->getRepository()->all(paginate: false);
   
        return view('public.candidates.index', [
            'candidates' => $candidates
        ]);
    }

    public function show(String $slug)
    {
        $candidatesService = new CandidatesService(); 
        $candidate = $candidatesService->getRepository()->findOneWhere(['slug' => $slug]);
        $candidates = $candidatesService->getRepository()->all(paginate: false);

        return view('public.candidates.show', [
            'candidate' => $candidate,
            'candidates' => $candidates,
            'scripts' => [
                'https://www.google.com/recaptcha/api.js?hl=pt-BR',
                asset('js/candidates.js'),
            ]
        ]);
    }

    public function makeVote(VoteRequest $request) {

        // validar google recaptha 
        $validate = $this->validateRecaptcha($request->input('recaptcha'));

        if(!$validate){
            return response()->json([
                'message' => 'Falha na validação do recaptcha!'
            ], 403);
        }
        

        $payload = [
            'cpf' => $request->input('cpf'),
            'full_name' => $request->input('full_name'),
            'phone' => $request->input('phone'),
            'candidate_id' => $request->input('candidate')
        ];

        $voteService = new VoteService();
        $allReadyVoted = $voteService->validateIfAlreadyVoted($payload['cpf']);

        if($allReadyVoted){
            $isSubscribed = $voteService->validateIfIsSubscribed($payload['cpf']);

            if(!$isSubscribed) {
                return response()->json([
                    'message' => 'Deve ser assinante para votar mais de uma vez!'
                ], 403);
            }
        }

        $voteService->save($payload);
        Candidates::find($payload['candidate_id'])->increment('votes');
        return $voteService->save($payload);  
    }

    private function validateRecaptcha(String $recaptchaResponse)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET'),
                'response' => $recaptchaResponse,
            ]
        ]);

        $body = json_decode((string)$response->getBody());

        if ($body->success) {
            return true;
        } 

        return false;
    }
}
