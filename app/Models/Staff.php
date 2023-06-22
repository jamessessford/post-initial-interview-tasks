<?php

namespace App\Models;

use Parental\HasParent;

class Staff extends User
{
    use HasParent;

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function isAdmin()
    {
        return false;
    }
}
