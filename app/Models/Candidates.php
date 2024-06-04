<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    use HasFactory;
    
    protected $table = 'candidates';

    protected $appends = ['display_weight'];

    public function getDisplayWeightAttribute()
    {
        return number_format($this->weight / 100, 2, ',', '.') . " m";
    }
}
