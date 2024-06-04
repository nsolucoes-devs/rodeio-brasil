<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    use HasFactory;
    protected $table = 'votes';
    protected $fillable = ['candidate_id', 'full_name', 'cpf', 'phone'];

    public function candidate()
    {
        return $this->belongsTo(Candidates::class, 'candidate_id');
    }
}
