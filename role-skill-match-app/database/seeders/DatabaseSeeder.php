<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Access_Rights;
use App\Models\Application;
use App\Models\Permission;
use App\Models\Permission_Rights;
use App\Models\Proficiency;
use App\Models\Role_Skill;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            DepartmentSeeder::class,
            CountrySeeder::class,
            PermissionSeeder::class,
            AccessRightsSeeder::class,
            PermissionRightsSeeder::class,
            ProficiencySeeder::class,
            SkillSeeder::class,
            StaffSeeder::class,
            StaffSkillSeeder::class,
            RoleSeeder::class,
            ApplicationSeeder::class,
            HiringManagerSeeder::class,
            RoleSkillSeeder::class,
            RoleListingSeeder::class
        ]);
    }
}
