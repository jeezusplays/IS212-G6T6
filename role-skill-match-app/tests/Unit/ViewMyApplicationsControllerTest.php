<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use App\Models\Application;
use App\Models\Role_Listing;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;

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
