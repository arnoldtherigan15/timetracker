<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['buddy_id', "phase_id", "score", "notes", "week"];

    public function buddy()
    {
        return $this->belongsTo(Buddy::class, 'buddy_id');
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class, 'phase_id');
    }
}
