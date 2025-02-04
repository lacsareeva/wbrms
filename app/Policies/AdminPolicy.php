<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the admin dashboard.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin // This is not actually used, but the signature is needed for Laravel's authorization system
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user instanceof Admin;
    }
}