<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamChangeRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamChangeRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classroomIds=Classroom::all()->pluck("id");
        $examIds=Exam::all()->pluck("id");
        for($i=0;$i<5;$i++){
            ExamChangeRequest::factory()->create(
                [
                    "new_classroom"=>$classroomIds->random(),
                    "exam_id"=>$examIds->random()
                ]
            );
        }
    }
}
