<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'note', 'noteable_type', 'noteable_id'];

    public function noteable(): MorphTo
    {
        return $this->morphTo();
    }
}
