<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'type'];

    public static function findOneComplaint($id)
    {
        return self::findOrFail($id);
    }

    public static function updateOneComplaint($id,$status): string
    {
        try {
            $complaint = self::findOneComplaint($id);
            $complaint->status = $status;
            $complaint->save();
            return 'Complaint updated successfully!';
        } catch (\Throwable $th) {
            return 'An error has occurred';
        }
    }
}
