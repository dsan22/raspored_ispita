<?php

namespace Database\Factories;

use App\Models\ExaminationPeriodName;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExaminationPeriod>
 */
class ExaminationPeriodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $startDate = $this->faker->dateTimeBetween('now', '+1 year');
        $endDate = (clone $startDate)->modify('+3 week');

        return [
            'examination_period_name_id' => ExaminationPeriodName::factory(),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ];
    }
}
