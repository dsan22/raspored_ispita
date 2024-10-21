<?php

namespace Database\Seeders;

use App\Models\ExaminationPeriodName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExaminationPeriodNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExaminationPeriodName::factory(6)->create();
    }
}
