<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::all()->each(function ($student) {
            Subject::factory()->count(8)->create([
                'student_id' => $student->id
            ]);
        });
    }
}
