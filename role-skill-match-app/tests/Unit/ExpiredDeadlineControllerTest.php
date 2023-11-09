<?php

use App\Http\Controllers\ExpiredDeadlineController;
use App\Models\Role_Listing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpiredDeadlineControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testExpiredDeadlineUpdatesStatus()
    {
        // Seed the database with a Role_Listing record
        Role_Listing::Updateorcreate([
            'listing_id' => 2,
            'role_id' => 2,
            'description' => 'Lorem ipsum dolor sit amet',
            'department_id' => 2,
            'country_id' => 2,
            'work_arrangement' => 1,
            'vacancy' => 5,
            'status' => 1,
            'deadline' => '2023-06-06',
            'created_by' => 5,
        ]);

        // Create an instance of the ExpiredDeadlineController
        $expiredDeadlineController = new ExpiredDeadlineController();

        // Call the updateStatusForExpiredDeadlines method
        $expiredDeadlineController->updateStatusForExpiredDeadlines();

        // Retrieve the updated Role_Listing record from the database
        $updatedRoleListing = Role_Listing::find(2);
        // Assert that the status has been updated to 2
        $this->assertEquals(2, $updatedRoleListing->status);
    }

    public function testUpdateStatusWhenVacancyIs0()
    {
        // Seed the database with a Role_Listing record
        Role_Listing::Updateorcreate([
            'listing_id' => 2,
            'role_id' => 2,
            'description' => 'Lorem ipsum dolor sit amet',
            'department_id' => 2,
            'country_id' => 2,
            'work_arrangement' => 1,
            'vacancy' => 0,
            'status' => 1,
            'deadline' => '2024-01-06',
            'created_by' => 5,
        ]);

        // Create an instance of the ExpiredDeadlineController
        $expiredDeadlineController = new ExpiredDeadlineController();

        // Call the updateStatusForExpiredDeadlines method
        $expiredDeadlineController->updateStatusForExpiredDeadlines();

        // Retrieve the updated Role_Listing record from the database
        $updatedRoleListing = Role_Listing::find(2);

        // Assert that the status has been updated to 2
        $this->assertEquals(2, $updatedRoleListing->status);
    }
}
