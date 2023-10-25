<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

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

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
