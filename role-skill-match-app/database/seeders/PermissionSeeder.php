<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permission')->insert([
            ['permission_id' => 1, 'permission' => 'create'],
            ['permission_id' => 2, 'permission' => 'read'],
            ['permission_id' => 3, 'permission' => 'update'],
            ['permission_id' => 4, 'permission' => 'delete'],
            // Add more permissions here
        ]);
    }
}
