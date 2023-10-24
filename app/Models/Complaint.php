<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'summary',
        'full_text',
        'status',
        'complaint_type',
    ];

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
