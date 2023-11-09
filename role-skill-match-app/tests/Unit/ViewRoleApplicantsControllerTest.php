<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Tests\TestCase;

class ViewRoleApplicantsControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testViewRoleApplicants()
    {
        // Perform a GET request to your controller method
        $staffId = 8;
        $listingId = 1;
        $response = $this->get("/staff_id={$staffId}/view-role-applicants/listingID={$listingId}");
        $response->assertStatus(200);
        $response->assertViewHasAll(['roles', 'isRoleValid']);

    }
}
