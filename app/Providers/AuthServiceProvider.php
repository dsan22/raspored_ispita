<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Classroom;
use App\Models\Department;
use App\Models\Exam;
use App\Models\ExamChangeRequest;
use App\Models\ExaminationPeriod;
use App\Models\ExaminationPeriodName;
use App\Models\Subject;
use App\Models\User;
use App\Policies\AdministratorPolicy;
use App\Policies\ExamChangeRequestPolicy;
use App\Policies\ExamPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Classroom::class => AdministratorPolicy::class,
        Department::class => AdministratorPolicy::class,
        Exam::class => ExamPolicy::class,
        ExaminationPeriod::class => AdministratorPolicy::class,
        ExamChangeRequest::class => ExamChangeRequestPolicy::class,
        ExaminationPeriodName::class => AdministratorPolicy::class,
        Subject::class => AdministratorPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
