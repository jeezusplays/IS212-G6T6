<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\UpdateRoleController;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role_Listing;
use Illuminate\Database\Query\Builder;

class UpdateRoleControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testUpdateRoleListing()
    {
        // Prepare the request data
        $requestData = [
            'listingID' => 1,
            'roleTitle' => 1,
            'workArrangement' => 1,
            'department' => 1,
            'vacancy' => 4,
            'deadline' => '2023-12-31',
            'description' => 'Lorem ipsum dolor sit amet',
            'Country_ID' => 1,
            'Status' => 1,
            'skills' => [1, 2, 3],
            'hiringManager' => [6, 7],
        ];
        
        $response = $this->post('/updateRole', $requestData);
        
        // Assert the response is successful (e.g., a 200 status code)
        $response->assertStatus(Response::HTTP_FOUND);
    
        // Follow the redirect and assert the final response code
        $finalResponse = $this->followRedirects($response);
        $finalResponse->assertStatus(Response::HTTP_OK);
        
    }

    public function testEditRoleDetailsView()
    {
        // Perform a GET request to your route
        $staffId = 5;
        $listingId = 5;
        $response = $this->get("/staff_id={$staffId}/edit/listingID={$listingId}");
        $response->assertStatus(200);
        $response->assertViewHasAll(['roles', 'rolesDDL', 'departments', 'hiringManagers', 'skills', 'countries']);
    }
}
