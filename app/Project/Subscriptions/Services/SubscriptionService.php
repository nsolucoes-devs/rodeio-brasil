<?php 

namespace App\Project\Subscriptions\Services;

use App\Project\Common\Abstracts\AbstractService;
use App\Project\Subscriptions\Repositories\SubscriptionRepository;

class SubscriptionService extends AbstractService
{
    public function __construct()
    {
        $this->repository = new SubscriptionRepository();
    }

    public function validateIfAlreadySubscribed($cpf) {
        return $this->repository->findOneWhere(['cpf' => $cpf]);
    }
}