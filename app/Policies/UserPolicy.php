<?php
namespace App\Policies;

use App\Models\User;


class UserPolicy extends AdministratorPolicy
{
    public function seeUsers(User $user): bool
    {
        return $user->is_admin;
    }
    
}
