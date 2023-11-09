<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'permission_id' => 1,
            'permission' => 'create',
        ]);
        Permission::create([
            'permission_id' => 2,
            'permission' => 'read',
        ]);
        Permission::create([
            'permission_id' => 3,
            'permission' => 'update',
        ]);
        Permission::create([
            'permission_id' => 4,
            'permission' => 'delete',
        ]);
        // Add more permissions here
    }
}
