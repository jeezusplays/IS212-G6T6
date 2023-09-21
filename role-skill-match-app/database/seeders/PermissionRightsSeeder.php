<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: Not sure if needed
        // DB::table('permission_rights')->insert([
        // access id 1 = user, 2 = manager, 3 = hr
        // ]);
        DB::table('permission_rights')->insert([
            ['access_id' => 1, 'permission_id' => 1],
            ['access_id' => 1, 'permission_id' => 2],
            ['access_id' => 1, 'permission_id' => 3],

            ['access_id' => 2, 'permission_id' => 1],
            ['access_id' => 2, 'permission_id' => 2],
            ['access_id' => 2, 'permission_id' => 3],


            ['access_id' => 3, 'permission_id' => 1],
            ['access_id' => 3, 'permission_id' => 2],
            ['access_id' => 3, 'permission_id' => 3],
            ['access_id' => 3, 'permission_id' => 4],
            // Add more permissions here
        ]);

    }
}
