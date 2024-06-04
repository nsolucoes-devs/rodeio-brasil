<?php 

namespace App\Project\HistoryPaymentLinks\Repositories;

use App\Models\PaymentLinks;
use App\Project\Common\Abstracts\AbstractRepository;

class HistoryPaymentLinksRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new PaymentLinks();
    }
}