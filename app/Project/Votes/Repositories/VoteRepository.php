<?php 

namespace App\Project\Votes\Repositories;

use App\Models\Votes;
use App\Project\Common\Abstracts\AbstractRepository;

class VoteRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Votes();
    }
}