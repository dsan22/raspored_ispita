<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExaminationPeriod;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $examinationPeriodIds = ExaminationPeriod::all()->pluck("id");
        $subjectIds = Subject::all()->pluck("id");
        $classroomIds= Classroom::all()->pluck("id");
        for($i=0;$i<10;$i++){
            Exam::factory()->create(
             [
                 "examination_period_id"=>$examinationPeriodIds->random(),
                 "subject_id"=>$subjectIds->random(),
                 "classroom_id"=>$classroomIds->random()
             ]
         );
        }
    }
}
