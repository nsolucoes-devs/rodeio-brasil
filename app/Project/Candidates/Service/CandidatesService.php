<?php 

namespace App\Project\Candidates\Service;

use App\Project\Candidates\Repositories\CandidatesRepository;
use App\Project\Common\Abstracts\AbstractService;

class CandidatesService extends AbstractService
{
    public function __construct()
    {
        $this->repository = new CandidatesRepository();
    }

}