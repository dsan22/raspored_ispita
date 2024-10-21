<?php

namespace Database\Seeders;

use App\Models\ExaminationPeriod;
use App\Models\ExaminationPeriodName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExaminationPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ids=ExaminationPeriodName::all()->pluck("id");
        for($i=0;$i<2;$i++){
            ExaminationPeriod::factory()->create(
                [
                'examination_period_name_id' =>$ids->random()
                ]
            );
        }
       
    }
}