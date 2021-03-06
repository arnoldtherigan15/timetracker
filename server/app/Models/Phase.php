<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function score()
    {
        return $this->hasMany(Score::class, 'phase_id');
    }
}
