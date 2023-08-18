<?php

namespace App\Models;

use Parental\HasParent;

class Staff extends User
{
    use HasParent;

    public function user() {
        return $this->hasMany(User::class);
    }
}
