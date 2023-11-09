<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;

class ViewMyApplicationsControllerTest extends TestCase
{
    public function testViewAllApplications()
    {
        // Perform a GET request to your controller method
        $response = $this->get(route('view-all-applications', ['staff_id' => 1]));

        // Assert the HTTP response status code (assuming you return a view)
        $response->assertStatus(200);

        $response->assertViewHasAll([
            'roles',
            'departments',
            'countries',
            'skills',
        ]);
    }
}
