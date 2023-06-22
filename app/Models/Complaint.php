<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'category'];
    const CATEGORY_COMPLAINT = 'complaint';
    const CATEGORY_DISSATISFACTION = 'dissatisfaction';

    const STATUS_NOT_ACKNOWLEDGED = 'not_acknowledged';
    const STATUS_PENDING_INVESTIGATION = 'pending_investigation';
    const STATUS_UNDER_INVESTIGATION = 'under_investigation';
    const STATUS_RESOLVED_JUSTIFIED = 'resolved_justified';
    const STATUS_RESOLVED_UNJUSTIFIED = 'resolved_unjustified';


    public static function getCategories()
    {
        return [
            self::CATEGORY_COMPLAINT => 'Complaint',
            self::CATEGORY_DISSATISFACTION => 'Dissatisfaction',
        ];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_NOT_ACKNOWLEDGED => 'Not Acknowledged',
            self::STATUS_PENDING_INVESTIGATION => 'Pending Investigation',
            self::STATUS_UNDER_INVESTIGATION => 'Under Investigation',
            self::STATUS_RESOLVED_JUSTIFIED => 'Resolved & Justified',
            self::STATUS_RESOLVED_UNJUSTIFIED => 'Resolved & Unjustified',
        ];
    }

    public static function transitions()
    {
        return [
            self::STATUS_NOT_ACKNOWLEDGED => [self::STATUS_PENDING_INVESTIGATION],
            self::STATUS_PENDING_INVESTIGATION => [self::STATUS_UNDER_INVESTIGATION],
            self::STATUS_UNDER_INVESTIGATION =>[self::STATUS_RESOLVED_JUSTIFIED, self::STATUS_RESOLVED_UNJUSTIFIED],
        ];

    }

    public static function requireAdmin()
    {
        return [self::STATUS_UNDER_INVESTIGATION,self::STATUS_RESOLVED_JUSTIFIED,self::STATUS_RESOLVED_UNJUSTIFIED];
    }
    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'noteable');
    }
}
