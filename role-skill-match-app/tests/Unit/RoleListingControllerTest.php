<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleListingControllerTest extends TestCase
{
    // Refresh the database after each test
    use RefreshDatabase;

    /**
     * Positive test case.
     */
    public function test_store_new_role_listing()
    {

        $response = $this->post('/create-role', [
            'Role_ID' => 1,
            'Description' => 'Test Description',
            'Department_ID' => 3,
            'Country_ID' => 1,
            'Staff_ID' => [6],
            'Skills' => [1, 2, 3],
            'Work_Arrangement' => 1,
            'Vacancy' => 1,
            'Status' => 1,
            'Deadline' => '2024-04-01',
            'Created_By' => 5,

        ]);

        $response->assertRedirect('/create-role')->with(['success' => 'Role listing created successfully']);
        $this->assertDatabaseCount('role_listing', 13);
        $this->assertDatabaseCount('hiring_manager', 12);
        $this->assertDatabaseCount('role_skill', 23);
    }

    /**
     * Negative test case for Role doesn't exist.
     */
    public function test_store_new_role_listing_where_role_doesnt_exist()
    {

        $response = $this->post('/create-role', [
            'Role_ID' => 100,
            'Description' => 'Test Description',
            'Department_ID' => 3,
            'Country_ID' => 1,
            'Staff_ID' => [6],
            'Skills' => [1, 2, 3],
            'Work_Arrangement' => 1,
            'Vacancy' => 1,
            'Status' => 1,
            'Deadline' => '2024-04-01',
            'Created_By' => 5,

        ]);

        $response->assertRedirect('/create-role')->with(['error' => 'Role does not exist']);
        $this->assertDatabaseCount('role_listing', 12);
    }

    /**
     * Negative test case for Role listing already exists.
     */
    public function test_store_new_role_listing_role_listing_already_exists()
    {

        $response = $this->post('/create-role', [
            'Role_ID' => 1,
            'Description' => 'Test Description',
            'Department_ID' => 1,
            'Country_ID' => 1,
            'Staff_ID' => [6],
            'Skills' => [1, 2, 3],
            'Work_Arrangement' => 1,
            'Vacancy' => 1,
            'Status' => 1,
            'Deadline' => '2024-04-01',
            'Created_By' => 5,

        ]);

        $response->assertRedirect('/create-role')->with(['error' => 'Role listing already exists']);
        $this->assertDatabaseCount('role_listing', 13);
    }

    /**
     * Positive test case for setup method.
     */
    public function test_setup()
    {
        $response = $this->get('/create-role');
        $response->assertViewHasAll([
            'header',
            'rolesDDL',
            'title',
            'vacancy',
            'deadline',
            'skills',
            'description',
            'deptDDL',
            'workArrangementDDL',
            'countryID_DDL',
            'Staff_ID',
            'hiringManagerDDL',
            'status',
            'Staff_ID',
        ]);
    }

    /**
     * Positive test case for index method.
     */
    public function test_index()
    {
        $response = $this->get('/role-listings');
        $response->assertViewHasAll([
            'roles',
        ]);
    }
}
