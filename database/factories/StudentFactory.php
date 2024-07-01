<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'birthdate' => fake()->date('Y_m_d'),
            'sex' => fake()->randomElement(['MALE', 'FEMALE']),
            'address' => fake()->address(),
            'year' => fake()->numberBetween(1, 4),
            'course' => fake()->randomElement(['BSIT', 'BSCS']),
            'section' => fake()->randomElement(['A', 'B', 'C']),
        ];
    }
}
