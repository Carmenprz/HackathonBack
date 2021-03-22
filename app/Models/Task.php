<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hour',
        'date',
        'repetition_frequency',
        'advice', 
        'end_message', 
        'is_finished',
        'user_id',
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }
}
