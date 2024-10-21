<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\ExamChangeRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExamChangeRequestPolicy
{

    public function seeRequests(User $user): bool
    {
        return $user->is_admin;
    }
    public function seeUsersRequests(User $user,User $owner): bool
    {
        return $user->id===$owner->id;
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,Exam $exam): bool
    {
        return $user->id==$exam->subject->user->id;
    }

 
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ExamChangeRequest $examChangeRequest): bool
    {
        return $user->id==$examChangeRequest->exam->subject->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ExamChangeRequest $examChangeRequest): bool
    {
        return $user->is_admin||$user->id==$examChangeRequest->exam->subject->user->id;
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
    public function forceDelete(User $user, ExamChangeRequest $examChangeRequest): bool
    {
        return $user->is_admin||$user->id==$examChangeRequest->exam->subject->user->id;
    }
    
    public function approve(User $user): bool
    {
        return $user->is_admin;
    }

    public function denie(User $user): bool
    {
        return $user->is_admin;
    }

}
