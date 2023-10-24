<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id', // Add 'complaint_id' to the fillable array
        'user_id',
        'content',
    ];
}
