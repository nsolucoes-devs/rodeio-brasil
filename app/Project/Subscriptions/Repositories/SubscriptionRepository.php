<?php 

namespace App\Project\Subscriptions\Repositories;

use App\Models\Subscriptions;
use App\Project\Common\Abstracts\AbstractRepository;

class SubscriptionRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Subscriptions();
    }
}