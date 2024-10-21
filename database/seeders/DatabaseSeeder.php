<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classroom;
use App\Models\Department;
use App\Models\Exam;
use App\Models\ExamChangeRequest;
use App\Models\ExaminationPeriod;
use App\Models\ExaminationPeriodName;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                ClassroomSeeder::class,
                UserSeeder::class,
                DepartmentSeeder::class,
                ExaminationPeriodNameSeeder::class,
                ExaminationPeriodSeeder::class,
                SubjectSeeder::class,
                ExamSeeder::class,
                ExamChangeRequestSeeder::class
            ]
        );
    }
}
