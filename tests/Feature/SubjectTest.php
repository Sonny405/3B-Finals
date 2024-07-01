<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    public function test_get_subjects(): void
    {
        $response = $this->get('/api/students/1/subjects'); 
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
                        "id",
                        "student_id",
                        "subject_code",
                        "name",
                        "description",
                        "instructor",
                        "schedule",
                        "grades",
                        "average_grade",
                        "remarks",
                        "date_taken",
                    ]
                ]
            ])->assertJsonCount($response["metadata"]["limit"], 'students'); 
    }

}
