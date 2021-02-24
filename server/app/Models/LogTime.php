<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTime extends Model
{
    use HasFactory;

    protected $fillable = ['buddy_id', 'date', 'total_hours', 'total_minutes'];

    public function buddy()
    {
        return $this->belongsTo(Buddy::class);
    }
}
