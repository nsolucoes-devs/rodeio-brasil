<?php 

namespace App\Project\Candidates\Repositories;

use App\Models\Candidates;
use App\Project\Common\Abstracts\AbstractRepository;

class CandidatesRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Candidates();
    }
}