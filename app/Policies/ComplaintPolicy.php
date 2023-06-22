<?php

namespace App\Policies;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ComplaintPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, Complaint $complaint): bool
    {
        if (!in_array($complaint->status, Complaint::requireAdmin())) {
            return true;
        }
        return $user->type === '\App\Models\Admin';
    }
}
