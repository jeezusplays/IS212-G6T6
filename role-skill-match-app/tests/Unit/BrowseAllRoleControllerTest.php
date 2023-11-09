<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Tests\TestCase;

class BrowseAllRoleControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testBrowseRoles()
    {
        // Perform a GET request to your controller method
        $response = $this->get(route('browse-roles', ['staff_id' => 1]));
        $response->assertStatus(200);
        $response->assertViewIs('browse-roles');
        $response->assertViewHas(['roles', 'departments', 'skills', 'countries', 'staff_skills', 'staff_id']);
    }
}
