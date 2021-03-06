<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['buddy_id', "phase_id", "score", "notes", "week"];

    public const WEEK = [
        'Week 1' => 1,
        'Week 2' => 2,
        'Week 3' => 3,
        'Week 4' => 4,
    ];

    public function buddy()
    {
        return $this->belongsTo(Buddy::class, 'buddy_id');
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class, 'phase_id');
    }
}
