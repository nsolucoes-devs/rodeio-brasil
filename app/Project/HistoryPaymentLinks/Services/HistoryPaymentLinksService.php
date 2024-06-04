<?php 

namespace App\Project\HistoryPaymentLinks\Services;

use App\Project\Common\Abstracts\AbstractService;
use App\Project\HistoryPaymentLinks\Repositories\HistoryPaymentLinksRepository;

class HistoryPaymentLinksService extends AbstractService
{
    public function __construct()
    {
        $this->repository = new HistoryPaymentLinksRepository();
    }
}