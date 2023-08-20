<?php

namespace App\Models;

use Parental\HasParent;

class Admin extends User
{
    use HasParent;

    // allow admins to update resolved complaints and edit notes
    protected $canUpdateResolvedComplaint = true;
    protected $canUpdateNotes = true;
}
