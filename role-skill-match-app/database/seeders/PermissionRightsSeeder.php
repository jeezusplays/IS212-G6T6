<?php

namespace Database\Seeders;

use App\Models\Permission_Rights;
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
        Permission_Rights::create([
            'access_id' => 1,
            'permission_id' => 1,
        ]);
        Permission_Rights::create([
            'access_id' => 1,
            'permission_id' => 2,
        ]);
        Permission_Rights::create([
            'access_id' => 1,
            'permission_id' => 3,
        ]);
        Permission_Rights::create([
            'access_id' => 2,
            'permission_id' => 1,
        ]);
        Permission_Rights::create([
            'access_id' => 2,
            'permission_id' => 2,
        ]);
        Permission_Rights::create([
            'access_id' => 2,
            'permission_id' => 3,
        ]);
        Permission_Rights::create([
            'access_id' => 3,
            'permission_id' => 1,
        ]);
        Permission_Rights::create([
            'access_id' => 3,
            'permission_id' => 2,
        ]);
        Permission_Rights::create([
            'access_id' => 3,
            'permission_id' => 3,
        ]);
        Permission_Rights::create([
            'access_id' => 3,
            'permission_id' => 4,
        ]);
        Permission_Rights::create([
            'access_id' => 4,
            'permission_id' => 1,
        ]);
        Permission_Rights::create([
            'access_id' => 4,
            'permission_id' => 2,
        ]);
        Permission_Rights::create([
            'access_id' => 4,
            'permission_id' => 3,
        ]);
        Permission_Rights::create([
            'access_id' => 4,
            'permission_id' => 4,
        ]);

        // Add more permissions here
    }
}
