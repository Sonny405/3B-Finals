<?php

namespace Database\Factories;

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
        $subject_code = fake()->randomElement(['IT', 'CS', 'HM', 'AB']) . (string)fake()->numberBetween(120, 450);
        $schedule = fake()->randomElement(['M', 'T', 'W', 'TH', 'F', 'S']) .
            (string)fake()->numberBetween(7, 12) . "am to " .
            (string)fake()->numberBetween(7, 12) . "pm";
        $grades_arr = fake()->randomElements([1.0, 1.25, 1.5, 1.75, 2.0, 2.25, 2.5, 2.75, 3.0, 4.0, 5.0], 4);
        $avg = array_sum($grades_arr) / count($grades_arr);
        $grades = implode(" | ", $grades_arr);
        $remarks = ($avg <= 3.0) ? "PASSED" : "FAILED";
        
        return [
            'subject_code' => $subject_code,              
            'name' => fake()->sentence(2),
            'description' => fake()->sentence(),
            'instructor' => fake()->name(),
            'schedule' => $schedule,
            'grades' => json_encode([
                'prelims' => $grades_arr[0],
                'midterms' => $grades_arr[1],
                'prefinals' => $grades_arr[2],
                'finals' => $grades_arr[3],
            ]),
            'average_grade' => $avg,
            'remarks' => $remarks,
            'date_taken' => fake()->date('Y_m_d'),
        ];
    }
}
