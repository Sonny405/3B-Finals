<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_students(): void
    {
        $response = $this->get('/api/students');
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'metadata' => [
                    "count",
                    "search",
                    "limit",
                    "offset",
                    "fields" => [],
                ],
                'students' => [
                    '*' => [
                        'id',
                        'firstname',
                        'lastname',
                        'birthdate',
                        'sex',
                        'address',
                        'year',
                        'course',
                        'section',
                    ]
                ]
            ])->assertJsonCount($response["metadata"]["limit"], 'students'); 
    }
    public function test_create_students()
    {
        $studentData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'birthdate' => '2000-01-01',
            'sex' => 'MALE',
            'address' => '123 Main St',
            'year' => 3,
            'course' => 'BSCS',
            'section' => 'A',
        ];

        $response = $this->postJson('/api/students', $studentData);

        $response
            ->assertStatus(201)
            ->assertJson([
                'firstname' => $studentData['firstname'] //Test if the Json response has the firstname data
            ]);

        $this->assertDatabaseHas('students_info', $studentData); //Test the DB with the rest of the field
    }

    public function test_update_students()
    {
        //Add a new student to be patched
        $student = Student::factory()->create();

        $updateData = [
             'firstname' => 'Updated Firstname',
             'lastname' => 'Updated Lastname',
             'birthdate' => '2001-02-02',
             'sex' => 'FEMALE',
             'address' => '456 Elm St',
             'year' => 4,
             'course' => 'BSIT',
             'section' => 'B',
         ];

         $response = $this->patchJson("/api/students/{$student->id}", $updateData);

         $response
             ->assertStatus(200)
             ->assertJson([
                 'firstname' => $updateData['firstname']
             ]);

         $this->assertDatabaseHas('students_info', $updateData);
     }
}
