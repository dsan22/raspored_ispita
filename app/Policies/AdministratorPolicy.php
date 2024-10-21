<?php

namespace App\Policies;

use App\Models\User;


class AdministratorPolicy
{
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

   
    public function update(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        return $user->is_admin;
    }
    /**
     * Determine whether the user can see deleted items.
     */

    public function seeDeleted(User $user): bool
    {
        return $user->is_admin;
    }
}
