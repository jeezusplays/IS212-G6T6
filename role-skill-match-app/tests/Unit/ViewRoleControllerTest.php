<?php

namespace Tests\Unit;

use Tests\TestCase;

class ViewRoleControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testViewRoleDetails(): void
    {
        $response = $this->get('/staff_id=1/view-role/listingID=1');
        $response->assertStatus(200);
        $response->assertViewHasAll(['roles', 'isRoleValid', 'staff_skills']);
    }
}
