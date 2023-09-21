<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        // create 5 countries using model
        Country::create([
            'country_id' => 1,
            'country_name' => 'Singapore',
        ]);
        Country::create([
            'country_id' => 2,
            'country_name' => 'Malaysia',
        ]);
        Country::create([
            'country_id' => 3,
            'country_name' => 'Indonesia',
        ]);
        Country::create([
            'country_id' => 4,
            'country_name' => 'Thailand',
        ]);
        Country::create([
            'country_id' => 5,
            'country_name' => 'Vietnam',
        ]);
    }
}
