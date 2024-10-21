<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names=[
            'Mathematics',
            'Algebra',
            'Geometry',
            'Science',
            'Geography',
            'History',
            'English',
            'Spanish',
            'German',
            'French',
            'Latin',
            'Greek',
            'Arabic',
            'Computer Science',
            'Art',
            'Economics',
            'Music',
            'Drama',
            'Physical Education',
        ];

        return [
            "name"=>$this->faker->randomElement($names),
            "department_id"=>Department::factory(),
            "user_id"=>User::factory()
        ];
    }
}
