<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;

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
