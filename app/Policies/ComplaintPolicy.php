<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Complaint;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

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

    public function upsert(User $user, Complaint $complaint): Response
    {
        switch ($complaint->status) {
            case 'Not acknowledged':
                return Response::allow();
                break;
            case 'Pending investigation':
                return Response::allow();
                break;
            case 'Under investigation' || 'Resolved & justified' || 'Resolved & unjustified':
                if($user->type == 'admin') {
                    return Response::deny('You must be an admin to edit this.');
                } else {
                    return Response::allow();
                }
                break;
        }
    }
}
