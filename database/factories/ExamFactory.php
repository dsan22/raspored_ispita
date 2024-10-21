<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\ExaminationPeriod;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $durations = ['02:00:00', '02:30:00', '03:00:00'];
        return [
            "date"=>$this->faker->dateTimeBetween("now","+1 year"),
            "time"=>$this->faker->time('H:00:00'),
            "duration"=>$this->faker->randomElement($durations),
            "examination_period_id"=>ExaminationPeriod::factory(),
            "subject_id"=>Subject::factory(),
            "classroom_id"=> Classroom::factory()
        ];
    }
}
