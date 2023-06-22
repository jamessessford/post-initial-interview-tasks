<?php

namespace App\Models;

use Parental\HasParent;

class Developer extends User
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
