<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\UpdateRoleController;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role_Listing;
use Illuminate\Database\Query\Builder;

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
