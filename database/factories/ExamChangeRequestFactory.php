<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamChangeRequest>
 */
class ExamChangeRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "new_date"=>$this->faker->dateTimeBetween("now","+1 year"),
            "new_time"=>$this->faker->time('H:00:00'),
            "new_classroom"=>Classroom::factory(),
            "change_approved"=>$this->faker->boolean(),
            "exam_id"=>Exam::factory()

        ];
    }
}
