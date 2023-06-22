<?php

namespace App\Models;

use Parental\HasParent;

class Admin extends User
{
    use HasParent;


    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function isAdmin()
    {
        return true;
    }
}
