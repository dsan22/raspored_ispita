<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
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
            "name"=>$this->faker->randomElement($names)." Department"
            
        ];
    }
}
