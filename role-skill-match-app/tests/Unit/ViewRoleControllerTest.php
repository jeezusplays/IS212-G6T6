<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\ViewRoleController;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role_Listing;
use Illuminate\Database\Query\Builder;

class ViewRoleControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testViewRoleDetails(): void
    {
        $response = $this->get("/staff_id=1/view-role/listingID=1");
        $response->assertStatus(200);
        $response->assertViewHasAll(['roles', 'isRoleValid', 'staff_skills']);
    }
}
