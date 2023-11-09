<?php

namespace Tests\Unit;

use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApplicationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testApplicationCreationRoute()
    {
        // Manually create the necessary database records

        // Create mock data for the request
        $requestData = [
            'listing_id' => 4,
            'staff_id' => 1,
            'status' => 1,
            'application_date' => '2023-05-11',
        ];

        // Send a POST request to the application creation route
        $response = $this->post('/apply_role', $requestData);

        // Assert that the response has a redirect status code
        $response->assertStatus(Response::HTTP_FOUND);

        // Follow the redirect and assert the final response code
        $finalResponse = $this->followRedirects($response);
        $finalResponse->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseCount('application', 23);

    }
}
