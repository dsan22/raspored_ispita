<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departmentIds=Department::all()->pluck("id");
        $userIds=User::all()->pluck("id");
        for($i=0;$i<5;$i++){
            Subject::factory()->create(
                [
                    "department_id"=>$departmentIds->random(),
                    "user_id"=>$userIds->random()
                ]
            );
        }
    }
}
