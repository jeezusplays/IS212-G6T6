<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ViewRoleControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testViewRoleDetails(): void
    {
        $staffId = 1;
        $listingId = 10;
        $response = $this->get("/staff_id={$staffId}/view-role/listingID={$listingId}");
        $response->assertStatus(200);
        $response->assertViewHasAll(['roles', 'isRoleValid', 'staff_skills']);
    }
}
