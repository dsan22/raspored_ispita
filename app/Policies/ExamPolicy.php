<?php
namespace App\Policies;

use App\Models\User;


class ExamPolicy extends AdministratorPolicy
{
    public function seeUsersExams(User $user,User $owner): bool
    {
        return $user->id===$owner->id;
    }
}
