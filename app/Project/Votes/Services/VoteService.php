<?php 

namespace App\Project\Votes\Services;

use App\Classes\Assas;
use App\Project\Common\Abstracts\AbstractService;
use App\Project\Subscriptions\Services\SubscriptionService;
use App\Project\Votes\Repositories\VoteRepository;

class VoteService extends AbstractService
{
    public function __construct()
    {
        $this->repository = new VoteRepository();
    }

    public function validateIfAlreadyVoted(String $cpf)
    {
        return $this->repository->findOneWhere(['cpf' => $cpf]);
    }

    public function validateIfIsSubscribed(String $cpf)
    {
        $subscriptionService = new SubscriptionService();
        return $subscriptionService->validateIfAlreadySubscribed($cpf);
    }
}