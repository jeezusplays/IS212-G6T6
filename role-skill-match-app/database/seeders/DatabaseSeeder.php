<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Application;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

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
            RoleListingSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
