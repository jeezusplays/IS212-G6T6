<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class IndicateSkillProficiencyTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     */
    public function testIndicateSkillProficiencyView()
    {
        // Perform a GET request to your route
        $staffId = 1;
        $response = $this->get("/staff_id={$staffId}/indicate-skill-proficiency");
        $response->assertStatus(200);
        $response->assertViewHas('staff_skillset_proficiency');
    }

    public function testUpdateSkillProficiency()
    {
        // Prepare the request data
        $requestData = [
            'data' => [
                'staff_id' => 1,
                'skill_id' => 1,
                'proficiency_id_new_value' => 3,
            ],
        ];

        $response = $this->post('/update-skill-proficiency', $requestData);

        // Assert the response is successful (e.g., a 200 status code)
        $response->assertStatus(200);
    }
}
