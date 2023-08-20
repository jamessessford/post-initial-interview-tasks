<?php

namespace App\Models;

use Parental\HasParent;

class Staff extends User
{
    use HasParent;

    // allow staff to update notes
    protected $canUpdateNotes = true;
}
